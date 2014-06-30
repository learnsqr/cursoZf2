# Post Redirect Get 

REF: 
 
* <sup>1</sup> Multiple Editors. __"Post/Redirect/Get."__ _Wikipedia, the free encyclopedia._, 19 Mar 2014. Web [Post/Redirect/Get](http://en.wikipedia.org/wiki/Post/Redirect/Get). Accessed 25 Jun 2014.
* <sup>2</sup> Zend Framework Team. __"Post/Redirect/Get Plugin."__ _Zend\Mvc Controller Plugins._, Jun 2013. Web [Post/Redirect/Get Plugin](http://framework.zend.com/manual/2.3/en/modules/zend.mvc.plugins.html#zend-mvc-controller-plugins-postredirectget). Accessed 25 Jun 2014.

## Definition

Post/Redirect/Get (PRG) is a web development design pattern that prevents some duplicate form submissions, creating a more intuitive interface for user agents (users). PRG implements bookmarks and the refresh button in a predictable way that does not create duplicate form submissions.

## Duplicate form submissions

When a web form is submitted to a server through an HTTP POST request, a web user that attempts to refresh the server response in certain user agents can cause the contents of the original HTTP POST request to be resubmitted, possibly causing undesired results, such as a duplicate web purchase.

To avoid this problem, many web developers use the PRG pattern[1] — instead of returning a web page directly, the POST operation returns a redirection command. The HTTP 1.1 specification introduced the HTTP 303 ("See other") response code to ensure that in this situation, the web user's browser can safely refresh the server response without causing the initial HTTP POST request to be resubmitted. However most common commercial applications in use today (new and old alike) still continue to issue HTTP 302 ("Found") responses in these situations. The PRG pattern cannot address every scenario of duplicate form submission. Some known duplicate form submissions that PRG cannot solve are:

If a web user refreshes before the initial submission has completed because of server lag, resulting in a duplicate HTTP POST request in certain user agents.
A commonly used alternative to the PRG pattern is the use of a nonce to prevent duplicate form submissions.[2]

## Logic

` Zend\Mvc\Controller\Plugin\PostRedirectGet.php`  

* If a null value is present for the $redirect, the current route is retrieved and use to generate the URL for redirect.
* If the request method is POST, creates a session container set to expire after 1 hop containing the values of the POST. It then redirects to the specified URL using a status 303.
* If the request method is GET, checks to see if we have values in the session container, and, if so, returns them; otherwise, it returns a boolean false.
 
## Example Code  
    
    // Pass in the route/url you want to redirect to after the POST
	$prg = $this->prg('/user/register', true);
	
	if ($prg instanceof \Zend\Http\PhpEnvironment\Response) {
	    // returned a response to redirect us
	    return $prg;
	} elseif ($prg === false) {
	    // this wasn't a POST request, but there were no params in the flash messenger
	    // probably this is the first time the form was loaded
	    return array('form' => $myForm);
	}
	
	// $prg is an array containing the POST params from the previous request
	$form->setData($prg);
	
	// ... your form processing code here