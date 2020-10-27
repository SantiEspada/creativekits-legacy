# creativekits-legacy

Repository for the legacy PHP application that powered www.creativekits.es.

The code is an absolute mess but hey I did all of this when I were like 15 years old and had no idea about programming in general and PHP in particular so it's not that bad TBH.

The only changes I've made have been replacing credentials and dockerizing this so I could run it (back in the days this was running using XAMPP on a Windows Server EC2 in AWS), but other from that and some values (like the base_url, DB credentials, etc) nothing has changed from the original code.

Some cool things:

- inside /app/public_html there is an ongoing "beta" version
- inside /app/public_html/test there is yet another version
- there are multiple ways to generate a PDF file across these versions. I think the timeline was something like:
  1. Generate with PHP using something called mPDF? not sure if this did ever work
  1. Use an external service, PDFCrowd. This worked just fine but was a bit expensive so I ended up ditching it.
  1. At some moment, I managed to rent another server (this time it was Linux) just to expose a _"""microservice"""_ (Apache + a single PHP file) that generated a PDF file using `wkhtml2pdf`. I think this was the solution that I ended up using until closing. Unfortunately, I don't think I have the original code for that. But it was something like:
     - Receives an _id_ that actually was a hash of some secret string + the order ID. This prevented users from downloading invoices of other users (unless they knew somehow how to compute the hash which to be fair it wasn't that difficult. Oh, and also I think there was some s u p e r t o k e n that allowed anyone to download any invoice. Security&trade;)
     - Checks if a PDF file for that order already exists. If so, it just returns it. Otherwise, it uses `wkhtml2pdf` to render a PDF file from a webpage (I think it's `/admin/parsecart.php`) then returns it.
- Payments are handled by PayPal and its really old IPN system. All transaction happens client-side, then PayPal calls `/ppipn.php`. This file
  - Calls PayPal to verify the status of the payment.
  - Set the order status to "paid"
  - Sends an email.

    There is also another file to start the payment flow in case some user changed its mind about the payment method/something went wrong on the checkout process: `/processpaypal.php`. It receives the order ID and redirects the user to PayPal to complete the checkout.

- There was no backoffice or anything like that, so all changes had to be done manually in the database (well, I used PHPMyAdmin for that). There is however a little script to mark an order as processed that:
  - lowers the available stock for all its products
  - sends an email to the customer saying the order has been shipped? TBH I'm not sure, maybe we did just send them manually too.
- In `/img/mailimg` there is a little script that chooses a random image from a list of 7 email signatures. It was cool to see different signatures for each mail ;D
  - Bonus: in `/img` there are lots of images for different promos.
