import os
from flask import Flask, request, jsonify
import requests
from flask_cors import CORS

from email.message import EmailMessage
import ssl
import smtplib
from dotenv import load_dotenv

# from sendgrid import SendGridAPIClient
# from sendgrid.helpers.mail import Mail


app = Flask(__name__)
CORS(app)  # Enable CORS for all routes
load_dotenv()

def print_exception():
    exc_type, exc_obj, tb = sys.exc_info()
    f = tb.tb_frame
    lineno = tb.tb_lineno
    filename = f.f_code.co_filename
    linecache.checkcache(filename)
    line = linecache.getline(filename, lineno, f.f_globals)
    print('EXCEPTION IN ({}, LINE {} "{}"): {}'.format(filename, lineno, line.strip(), exc_obj))

@app.route('/send_email', methods=['POST'])
def send_email():
    try:

        # data = request.form.to_dict()
        data = request.get_json()
        print("received data", data)
        name = data['name']
        sender_email = data['email']  # User's email from the form
        subject = data['subject']
        message = data['message']

        email_sender =os.environ.get("EMAIL_ADDRESS")
        email_password = os.environ.get("EMAIL_PASSWORD")
        email_receiver=os.environ.get("EMAIL_ADDRESS")

        content= f"{message}\n\nClient Details:\n{name}\n{sender_email}"

        em = EmailMessage()
        em['From'] = email_sender
        em['To'] = email_receiver
        em['Subject'] = subject
        em.set_content(content)
        

        #add security
        context = ssl.create_default_context()

        with smtplib.SMTP_SSL('smtp.gmail.com',465, context=context) as smtp:
            smtp.login(email_sender, email_password)
            smtp.sendmail(email_sender, email_receiver, em.as_string())

        return jsonify({"status": "success"})

    except Exception as e:
        return ("An error occured: {}".format(str(e)))
        print_exception()


if __name__ == '__main__':
    app.run(debug=True)