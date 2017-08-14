<?php
/**
 * Created by PhpStorm.
 * User: Dorinel
 * Date: 14.08.2017
 * Time: 16:10
 */

namespace AppBundle\Controller;


use AppBundle\Entity\ReditPost;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RedditController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function listAction()
    {
        $post = $this->getDoctrine()->getRepository('AppBundle:ReditPost')->findAll();

        dump($post);

        return $this->render('reddit/index.html.twig',[
            'posts' => $post
        ]);
    }

    /**
     * @Route("/create/{text}", name="create")
     */
    public function creatAction($text)
    {
        $em = $this->getDoctrine()->getManager();

        $post = new ReditPost();
        $post->setTitle($text);

        $em->persist($post);
        $em->flush();

        return $this->redirectToRoute('home');
    }


    /**
     * @Route("/update/{id}/{text}", name="update")
     */
    public function updateActin($id, $text)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('AppBundle:ReditPost')->find($id);

        if (!$post){
            return $this->redirectToRoute('home');
        }

        $post->setTitle('updated ' . $text);

        $em->flush();

        return $this->redirectToRoute('home');
    }


    /**
     * @Route("/delete", name="delete")
     */
    public function deleteAction()
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('AppBundle:ReditPost')->find(2);

        if (!$post){
            return $this->redirectToRoute('home');
        }

        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('home');
    }


}