++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+
+	Module: Building Web Application using PHP with MySql
+   Federico Cocco
+   fcocco01 
+   Birkbeck University of London 
+   Tutor : John Macnabb 
+	Name app: W1FMA
+
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


# _Project_

	This application is an iterative photo-gallery that consents the users to upload their own JPEG image files
	and visualise them.
	A service to get details of a selected file in JSON format is present in the application.
	Future implementations involve Setting different sessions for MultiThreads use, 
	user's option to delete of own images from the gallery, and thus from folder where they are saved and Database row,
	Log in, Log out and Registration options, working without Cookies and acceptance and handle of different file types.
 
## Installation

	There is no need of installation as everything is set.
	If there is no the table wanted on the database selected,
	one can be easily created by using the sql query in 
	the file "create_table.sql", inside "/include/sql additional/".
		
 
## Configuration

	For admin_
	the file config.ini.php in "/include/" allows to change at will some settings such connection to database
	log in details, directories of images(and thumbnails), language,  and the keys accepted from the URL.	
	Queries settings are present inside "/include/model/queries.php".
	DO NOT delete entry in row in the database without deleting also the correspondent file, or vice-versa. 
	
	No external dependencies has been used for this application. 
	
## Pages with URL

	http://titan.dcs.bbk.ac.uk/~fcocco01/w1fma/index.php
	
	A web service is present, which returns a json object
	containing title, description, height and width of the selected image,as
	long it exist in the database.
	If not, does return an error message.
	It is accessible from the actual-size image view, or manually.
	If manually this is the URL it needs to start:
	http://titan.dcs.bbk.ac.uk/~fcocco01/w1fma/index.php?INFO&ID=
	
	It strictly needs an ID parameter to be pass to the URL.
	If it is not provided, the application does not produce errors, but neither
	it will show anything. It needs to be the a filename currently existing in database or
	it would produce error.
	Here is an example of the syntax (dummy file not inserted inside the database,
	an id needs to be checked first):
	http://titan.dcs.bbk.ac.uk/~fcocco01/w1fma/index.php?INFO&ID=570cd53497df5.jpg

## Use
	Upload in the ever-present form on top, pressing submission button.
	It always sends back to the default view.
	Select title next to thumbnail correspondent to view the actual image.
	Pressing on this image would send back to index (thumbnails/default view).
	Pressing on "Info web service" starts the web service for JSON on the
	current image displayed. 

## Testing

	Upload of different image file types rather than jpeg.
	Upload of jpeg either with or without description.
	Upload of jpeg of various measures.
	Test URL (ID empty, no ID, NO other PARAMETERS, only INFO, no set parameter, void message)
		


## Security 

	Do not change setting of file permissions on the server.
	img and thumb needs to be set as 777.
	Connection is destroyed after every view is output.
	A new connection is reinstated every time the entry point is loaded.
	
## Failure points (to be solved in the next version)

	Throwing of errors if the form is submitted without any file.
	Eventual concatenation of query.
	May produce problems with header during error handling, for being sent too many times.
	
## Error handled
	No parameter passed, or being incorrect type. Handlers most used: isset and is_(type)
	Connection return errors
	Mysql return errors.
	No data returned.
	Error decoding JSON
	Upload errors concerning incorrect type, tec...
	
	
Notes
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
* April 2016
 * I declare this being my work, designed and developed by myself. 
 I have also made use of the material provided on the slides, the FMA workshop and some code inspired from PHP manual and W3SCHOOL
