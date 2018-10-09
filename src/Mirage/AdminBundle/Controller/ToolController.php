<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-09
 * Time: 오후 6:10
 */

namespace Mirage\AdminBundle\Controller;

use Mirage\UserBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DomCrawler\Crawler;

class ToolController extends Controller
{
    /**
     * @Route("/", name="tool_index")
     * @Template()
     */
    public function indexAction(){

        return array();
    }


    /**
     * @Route("/changeXml", name="tool_xml")
     * @Template()
     */
    public function changeXmlAction(Request $request){
        $genre = $request->get('genre');
        $code = $request->get('code');
        $type = $request->get('type');
        $text = $request->get('text');

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML(file_get_contents(__DIR__.'/../../../../web/bundles/admin/'.$genre.'.xml'));

        $xpath = new \DOMXPath($dom);
        $xmlLine = $xpath->query('//StringTable//'.$genre.'[@id="'.$code.'"]//'.$type)->item(0);
        //빈 이름이면 생성
        if(empty($xmlLine->nodeValue)){
/*            귀찮다 나중에하자
            $skill =  $xpath->query('//StringTable//'.$genre.'[@id="'.$code.'"]')->item(0);
            $skill->
*/
        }else{
            $xmlLine->nodeValue = $text;
        }

        $dom->save(__DIR__.'/../../../../web/bundles/admin/'.$genre.'.xml');

        return new Response($xmlLine->textContent);






//        return new Response($this->ObjectToJson($xmlLine->text()));
    }
}