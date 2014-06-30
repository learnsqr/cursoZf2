<?php
// ./module/Application/src/Application/View/Helper/AbsoluteUrl.php
namespace Application\View\Helper;

use Zend\Http\Request;
use Zend\View\Helper\AbstractHelper;

class RouterTree extends AbstractHelper
{
	protected $request;

	

	public function __invoke()
	{
		function getRoutes($routes, $link=null)
		{
			foreach ($routes as $route)
			{
				//echo "<pre>";
				//print_r($route);
				//echo "</pre>";
				echo "<ul>";
				echo "<li>";
					echo "<a href=\"".$link.$route['options']['route']."\">".$route['options']['route']."</a>";
				echo "</li>";
				
					if(isset($route['child_routes']))
						getRoutes($route['child_routes'], $link.$route['options']['route']);
				echo "</ul>";
			}
		}
		return;
	}
}