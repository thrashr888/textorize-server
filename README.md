
## Installation

textorize-server requires textorize to be installed. Once it's installed, clone these files straight into your web root.

Install textorize from Gemcutter:

    $ gem install textorize --source http://gemcutter.org

Then clone textorize into your web root and setup the cache folder:

    $ cd <your project's web root>
    $ git clone git://github.com/thrashr888/textorize-server.git textorize-server
    $ chmod 777 textorize/cache

## Usage

Try it out on a webpage like so:

    <img src="/textorize-server/img.php?f=arial&s=20&c=000000&g=ffffff&m=just_a_test" alt="just_a_test">

Or in your browser here:

[http://localhost/textorize-server/test.html](http://localhost/textorize/test.html)

And it should come out looking like this:

![textorize-server test image](http://vastermonster.com/images/textorize-server-test.png "textorize-server test image")

So far, textorize-server supports these options:

*  f = font family (whatever is installed on your server)
*  s = font size
*  c = text color
*  g = background color
*  m = text message (don't forget to url encode!)

## How it works

textorize-server turns the url into arguments for textorize to run on the server. It then caches the generated image and serves from the cache. If the file already exists, it skips the generation and just serves the cached image.

## Disclaimer for Linux servers

textorize (I belive) only works on OS X because it uses MacRuby for it's image generation. A work-around for running this on your Linux servers is to view your website on your local machine and push the cached files to your server along with the code. This isn't perfect, but it should work!

## License & Credit

MIT License
Copyright (c) 2009 Paul Thrasher ([http://vastermonster.com](http://vastermonster.com))

textorize by Thomas Fuchs ([http://textorize.org/](http://textorize.org/))
