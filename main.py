import datetime
import jinja2
import os
import webapp2

from google.appengine.api import users

TEMPLATE_DIR = os.path.join(os.path.dirname(__file__), 'templates')
template_env = jinja2.Environment(loader=jinja2.FileSystemLoader(TEMPLATE_DIR))


class MainPage(webapp2.RequestHandler):
    def get(self):
        current_time = datetime.datetime.now()
        user = users.get_current_user()
        login_url = users.create_login_url(self.request.path)
        logout_url = users.create_logout_url(self.request.path)

        template = template_env.get_template('home.php')
        context = {
            'current_time': current_time,
            'user': user,
            'login_url': login_url,
            'logout_url': logout_url,
        }
        self.response.out.write(template.render(context))

application = webapp2.WSGIApplication([('/', MainPage)], debug=True)
