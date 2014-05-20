#!/usr/bin/env python3

# This file is part of YouXuse
 
# <YouXuse - web application to sell & buy componnents of tecnology>
# Copyright (C) <2013>  <Filipe Marques> <eagle.software3@gmail.com>

# YouXuse is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.

# YouXuse is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU Affero General Public License for more details.

# You should have received a copy of the GNU Affero General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

# For full reading of the license see the folder "license" 

# This file receive one argument from the php script createnewsletter.php and send back the result
# Make a search in google:
#	php.net documentation exec()
#	python 3.2 documentation sys.argv[]

# import the modules from the python standard library
import smtplib
import sys
import string

# import the packages, subpackages and modules from the python standard library
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

# module that have important strings
import store

# the main() function
def main():
	# me = my email address
			# module.variable
	me = store.my_email
	
	# receiving the two arguments from php script createnewsletter.php
	# you = recipient's email address
	you = sys.argv[1]
	
	dicio = {'prime_nome': sys.argv[2], 'ultim_nome': sys.argv[3]}
	
	# Create message container - the correct MIME type is multipart/alternative.
	msg = MIMEMultipart('alternative')
	msg['Subject'] = "This week you missed some action in YouXuse"
	msg['From'] = me
	msg['To'] = you

	# Create the body of the message (a plain-text and an HTML version).
	text = "Hi!\nHow are you?\n"
	html = """\
		<html>
			<head>
			</head>
			<body>
				<p>Hi! {prime_nome} {ultim_nome}<br>
				<h1>Go to <a href="http://youxuse.com/youxuse/index.php">YouXuse</a> and <a href="http://youxuse.com/nostress/index.php">NoStress</a> websites to find out more!</h1><br>
				<br>
				<h3>1 - What is the website YouXuse ?<br>
				The YouXuse website is a website where you can buy or sell used pieces of hardware (computers, laptops, mobile phones, smartphones, printers, monitors, ...) without any
				percentage of profit on transfer parts.<br>
				2 - What is the website Nostress ?<br>
				The Nostress website is a website where you can vent safely through your user account, using a nickname (alias). Other people may not know your nickname, because
				can know it's you. You can vent at will, trust that it is safe, then you can say bad about someone, you can insult, ... in short you can download and after that you will see how much better you feel !<br>
				3 - How can I help these websites ?<br>
				When you reach the website <a href="http://youxuse.com">YouXuse</a> you can make a donation of money, which will be used to support the costs of the website!<br>
				4 - Why is the website Nostress is on the same website address YouXuse ?<br>
				The developer and programmer site Filipe Marques, is unemployed and to save money on server and another web address and time, created this open-source system to group websites.
				<br>
				5 - There are pages on Facebook and Google+ ?<br>
				Yes, there are! The page <a href="https://www.facebook.com/youxuse">Facebook</a> and <a href="https://plus.google.com/u/0/b/116778377892072300095">Google+</a><br>
				Share these pages with your friends!
				Do not forget that if you need to buy apps you can buy in <a href="http://youxuse.com/youxuse/apps.php">YouXuse Apps</a>
				</h3>
				<br>
				<h2>PLEASE RESEND THIS MESSAGE TO ALL YOUR FRIENDS</h2>
				</p>
			</body>
		</html>
			""".format(**dicio) # the format() function receive a argument that is a dictionary - ** unpack the dictionary

	sender = store.sender_email
	passwd = store.password

	# Record the MIME types of both parts - text/plain and text/html.
	part1 = MIMEText(text, 'plain')
	part2 = MIMEText(html, 'html')

	# Attach parts into message container.
	# According to RFC 2046, the last part of a multipart message, in this case
	# the HTML message, is best and preferred.
	msg.attach(part1)
	msg.attach(part2)

	try:
		#instantiation of the class SMTP and connect the SMTP server in the port
		s = smtplib.SMTP('smtp.gmail.com', 587)
		s.ehlo()
		# Start secure connection
		s.starttls()
		s.ehlo()
		# Login to the SMTP server
		s.login(sender, passwd)
		# sendmail function takes 3 arguments: sender's address, recipient's address
		# and message to send - here it is sent as one string by as_string() function
		s.sendmail(me, you, msg.as_string())
		print("Email sent sucessfully !")
	except Exception:
		print("Error sending the email !")
	
	# Terminate the SMTP session and close connection
	s.quit()
	

# calling the main() function to run
if __name__ == "__main__":
	main()
