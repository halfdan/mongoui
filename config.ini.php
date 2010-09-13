; <?php exit ?> NEVER REMOVE THIS LINE

[General]
; Only change this if you have a complete translation!
default_language = "en_US"

; Only change this if you have a complete alternative theme!
default_theme = "default"

[Authentication]
; If authentication is disabled MongoUI tries to connect to
; MongoDB without authentication. (Default: 1);
enabled = 1
; Auth backend to use, can be "mongo" or "config"
; Mongo will use MongoDB + selected database (default: admin)
; to authenticate. Config
backend = mongo
; Username used to login (if backend = config)
username = "admin"
; Password used to login (if backend = config)
password = "secret"

[Debug]
; Displays errors in the UI
display_errors = 1

[Database]
; Default host of MongoDB instance
default[host] = "localhost"
; For replica sets just define a second entry
; second[host] = "10.0.0.1"



