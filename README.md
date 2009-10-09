
## Installation

textorize-server requires textorize to be installed. Once it's installed, clone these files straight into your webroot.

    $> sudo gem install textorize
    $> cd [webroot]
    $> git clone git://github.com/thrashr888/textorize-server.git textorize
    $> chmod 777 textorize/cache

Try it out on a webpage like so:

    <img src="/textorize/img.php?f=arial&s=20&c=000000&g=ffffff&m=just_a_test" alt="just_a_test">

It should come out looking like this:

![textorize-server test image](http://vastermonster.com/images/textorize-server-test.png "textorize-server test image")
