v1.2
=============
## 2011-07-15
### CHANGELOG
#### NEW
* The edit table now updates the colors
* The edit table now updates the rooms
* The font color in the main table switches to white in case of very dark background-color

#### CHANGED
* Better HTML semantics for easier CSS styling

#### FIXED
* Several mistakes in `de_DE` localization

### UPDATE NOTES
Simple changes, should not conflict any modifications.

### CHANGED FILES
	M       css/style.css
	M       css/usercss.php
	M       js/script.js
	A       js/userjs.php
	M       strings/de_DE.php
	M       templates/header.tpl
	M       templates/logged-in.tpl



v1.1
=============
## 2011-07-12
### CHANGELOG
#### NEW
* Ability to change password, username and email

#### CHANGED
* Account related settings got a own settings pane
* Javascript action with the public link setting

#### FIXED
* Several typos

### UPDATE NOTES
Changed the definition of the `strings/info.php`, so you have to change your file or run the installer again.

### CHANGED FILES
	A       action/account.php
	D       action/delete.php
	A       action/forgot-password.php
	M       action/save.php
	M       css/style.css
	M       install/step4.php
	M       js/script.js
	M       strings/de_DE.php
	M       strings/en_US.php
	A       templates/forgot-password.tpl
	M       templates/header.tpl
	M       templates/logged-in.tpl
	M       templates/login.tpl
	M       templates/public-view.tpl



v1.0
=============
## 2011-06-17