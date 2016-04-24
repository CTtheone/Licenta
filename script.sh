curl -s --user 'api:key-3ax6xnjp29jd6fds4gc373sgvjxteol0' \
    https://api.mailgun.net/v3/samples.mailgun.org/messages \
    -F from='Excited User <excited@samples.mailgun.org>' \
    -F to='cosmintom@yahoo.com' \
    -F subject='Hello' \
    -F text='Testing some Mailgun awesomeness Terminal!'

echo "Print din script!"
