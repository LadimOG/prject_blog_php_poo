<?php

use FastRoute\RouteCollector;

//route Admin
$r->get('/admin', ['App\Controllers\AdminController', 'showDashboard']);

//affichage de la page 404
$r->get('/404', ['App\Controllers\Page404', 'show404']);

// Définis la route pour la page d'accueil
$r->get('/', ['App\Controllers\HomeController', 'index']);

//affichache par categorie de post
$r->get('/category/{category}', ['App\Controllers\HomeController', 'showAllpostWithCategories']);

//ajouter un nouveau utilisateur dans la database
$r->get('/signup', ['App\Controllers\SignUpController', 'pageSignup']);
$r->post('/signup', ['App\Controllers\SignUpController', 'signup']);

//connection de l' utilisateur
$r->get('/login', ['App\Controllers\LoginController', 'pageLogin']);
$r->post('/login', ['App\Controllers\LoginController', 'login']);

//deconnection de l'utilisateur
$r->get('/logout', ['App\Controllers\LoginController', 'logout']);

//voir le post selectionner et ajouter un commentaire
$r->get('/post/{id:\d+}', ['App\Controllers\PostController', 'showPost']);

//--------------------------Espace Commentaire----------------------------
//envoyer vers la page pour ajouter un commentaire 
$r->get('/post/comment', ['App\Controllers\CommentController', 'viewAddComment']);
$r->post('/comment/add', ['App\Controllers\CommentController', 'addComment']);
//$r->post();
//supprimer des commentaires de l'utilisateuur si il est connecté.
$r->post('/comment/delete/{id:\d+}', ['App\Controllers\CommentController', 'deleteComment']);
//envoyer vers la pager de modification du commentaire
$r->get('/comment/{id:\d+}', ['App\Controllers\CommentController', 'viewUpdateComment']);
//modification du commentaire
$r->post('/comment/update/{id:\d+}', ['App\Controllers\CommentController', 'updateComment']);
