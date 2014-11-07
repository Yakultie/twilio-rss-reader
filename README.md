Twilio RSS reader
=================

This PHP script generates the [TwiML](https://www.twilio.com/docs/api/twiml) code to have a Twilio phone line read an RSS feed to you.

## How to use
1. Customise the configuration variables at the start of the file
2. Set up a Twilio number pointing to the PHP file
3. Listen to the news!

## Limitations
* Limited to the first 9 articles. You could change the <Gather> parameters to allow the entering of two digits followed by # to remove this limit.
* If the RSS feed changes between the time the script is started and an article is selected, the index will be incorrect and the wrong article will be read

## Contact
* Twitter: [@ffffelix](https://twitter.com/ffffelix)

## Licence
Licensed under the MIT License: http://opensource.org/licenses/MIT