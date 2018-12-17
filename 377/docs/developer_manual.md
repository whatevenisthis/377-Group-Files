This application is quite simple. It used HTML, PHP, and CSS. All logical code is in the index.php file. There is also the database.php which hold the connection information and style.css for CSS.

The index.php loads with a titles and introductions and provides the user with a dropdown (html form with the options pulled from a database query). When the user submits their selection, it posts to itself.

After posting the selected job, numerous queries are run to pull the statistics as well as the data to fill in the table.

Everything on the screen is done though PHP echo statements with the table being generated by a while loop.

The MySql database contains three tables: Degree, Instances, and Jobs.
Degree contains just the id associated with the education level and the education level in text.
Jobs contains just the id associated with the job title and the job title in text.
Instances is the equivalent of a person with a particular job and information with some information about them and foreign keys to the other tables.