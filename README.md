# Email-Link

This plugin creates a shortcode that allows you to insert a mailto link in your posts/pages, without the worry of exposing
the email address to various spiders and evil types on the web. It insteads insert JavaScript that works with jumbled up portions
of the email address, putting them back together once the JavaScript fires.

You can add your id and class to the shortcode just like an HTML element, as well as any other attributes you wish to add.
This will pick up on them and use them in the created link.
The exception is the "text" attribute, which will replace the email with the text set as what is displayed on the page.
This shortcode is used in the following manner:
```
   [email-link id="my-email" class="my-email" text="This is the text that becomes a link"]xyz@email.com[/email-link]
```
