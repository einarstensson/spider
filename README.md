<h1>Spider</h1>

<h3>Purpose</h3>
<p>I wanted to explore using PHP to build web crawlers and what advantages and disadvantages that would entail.</p>

<h3>Advantages</h3>
<p>+ Because PHP is so well suited for communicating across domains, it is realtively easy to use it to fetch HTML. In particular, I used the simple_html_dom.pg library and the file_get_html($url) method.</p>
<p>+ PHP let's you control how you handle robots.txt directives easily by including scripts provided by <a href="http://robotstxt.org" target="_blank">robotstxt.org</a> I wrote a <a href="http://einarstensson.herokuapp.com/" target="_blank">blog post</a> on this subject.</p>
<p>+ It is easy to use AJAX requests to handle the php crawl on the front-end.</p>

<h3>Disadvantages</h3>
<p>- The simple_html_dom file_get_html($url) method does not handle errors well, such as 404s. I ran into this problem and had trouble retracing my steps back in the program to figure out where to handle this exception. I realized I could use @file_get_html($url) to make sure I'd only get an empty string back in the event of errors but I still have'nt figured out where to deal with that.<p>
<p>- When you're not using a framework, the file structure tends to grow very quickly.</p>
<p>- Using a PHP web crawler for very large sites is not a good idea because the execution time may approach hours for large sites. It is therefore preferable to use a framework such as Rails and schedule the crawls to update a database with the required domains once a day (e.g. during the night) using rake tasks.</p>

<h3>Lessons Learned</h3>
<p>It was really interesting to build this using PHP. I both got more practice using Object Oriented Design in PHP and got a better understanding for how the flow of requests work between domains.</p>

