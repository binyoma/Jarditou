
<body>
    <div class='container'>
        <header>
        <figure class='Logo'> 
            <img src='assets/images/jarditou_logo.jpg' width='15%'  alt='Logo Jarditou' >
            <figcaption class='caption'> Nous contacter</figcaption>
        </figure>
        </header> 
    <div class='menu'>
    <nav id='navbar' class='navbar navbar-expand-sm bg-dark navbar-dark'>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#collapsibleNavbar'>
        <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='collapsibleNavbar'>
            <ul class='navbar-nav'>
                <li class='nav-item'>
                    <a class='nav-link' href='index.html'>Accueil</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='tableau.html'>Nos produits</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='Horaires.html'>Heures d'ouvertures </a>
                </li>
            </ul>
        </div> 
    </nav>
    </div>
<div class='row'>
        <form role='form'   action='formulaire10.php'  method='POST' class='needs-validation' novalidate>
            <div class='form-check form-check-inline'>
                <input class='form-check-input' type='radio' name='sexe' id='monsieur' value='M'>
                <label class='form-check-label' for='monsieur'>M.</label>
            </div>
            <div class='form-check form-check-inline'>
                <input class='form-check-input' type='radio' name='sexe' id='madame' value='F'>
                <label class='form-check-label' for='madame'>Mme</label>
            </div>
            <div class='form-check form-check-inline'>
                <input class='form-check-input' type='radio' name='sexe' id='autre' value='A' >
                <label class='form-check-label' for='autre'>Autre</label>
            </div>
            <div class='form-row form-group'>
                <div class='col-5'>
                    <input type='text' class='form-control' name='prenom' maxlength='30' placeholder='Prénom'>
                    <small id='firstnameHelpBlock' class='form-text text-muted'>
                     Votre prénom doit d'écrire avec seulement 30 lettres, pas de chiffres, pas de caractères spéciaux
                    </small>
                </div>
                <div class='col-5'>
                    <input type='text' class='form-control'  name='nom' maxlength='30' placeholder='Nom'>
                    <small id='lastnameHelpBlock' class='form-text text-muted'>
                     Votre nom doit d'écrire avec seulement 30 lettres, pas de chiffres, pas de caractères spéciaux
                    </small>
                </div>
               <div class='col-2'>
                    <input type='Date' class='form-control'name='naissance' placeholder='Date de Naissance'
                    min='1920-01-01' max='2003-01-01'>
                    <small id='birthdayHelpBlock' class='form-text text-muted'>
                     Votre date de naissance, vous devez être majeur et pas centaire
                    </small>
                </div>
            </div>
            <div class='form-row form-group'>
                <div class='col-6'>
                   <input type='text' name='adresse' class='form-control' maxlength='50' placeholder='Adresse'>
                   <small id='adressHelpBlock' class='form-text text-muted'>
                     Votre adresse doit s'écrire avec 50 lettres et  chiffres, pas de caractères spéciaux
                    </small>
                </div>
                <div class='col'>
                    <input type='number' name='cp' class='form-control' minlength='8' maxlength='8'placeholder='Code Postal'>
                    <small id='zipHelpBlock' class='form-text text-muted'>
                     Seulement les cinq chiffres
                    </small>
                </div>
                <div class='col-4'>
                    <input type='text' name='ville' class='form-control' maxlength='30' placeholder='Ville'>
                    <small id='lastnameHelpBlock' class='form-text text-muted'>
                     Votre ville doit d'écrire avec seulement des lettres, pas de chiffres, pas de caractères spéciaux
                    </small>
                </div>
            </div>
            <div class='form-group row'>
                <label for='mail' class='col-sm-2 col-form-label'>Email</label>
                <div class='col-sm-10'>
                    <input type='email' class='form-control' id='mail' name='mail'>
                    <small id='lastnameHelpBlock' class='form-text text-muted'>
                     Un email valide, svp!
                    </small>
                </div>
            </div>
            <div class='form-group'>
                <select id='objet'  name='objet' class='custom-select' > 
                    <option value='objet'>Objet</option>
                    <option value='Commande'> Commande </option>
                    <option value='réclamation'> réclamation </option>
                    <option value='info'> Demande d'information</option>
                </select><span id='spanobjet'></span>
            </div>
            <div class='input-group'>
                <div class='input-group-prepend'>
                        <span class='input-group-text' >message</span>
                </div>
                <textarea id='message' name='message' class='form-control' aria-label='message' ></textarea>
                <span id='spantext'></span>
            </div>
            <div class='form-check'>
                <input type='checkbox' class='form-check-input' id='accepter' name='accepter'> 
                <label class='form-check-label' for='accepter' >J'accepte le traitement informatique de ce formulaire</label>
            </div>
            <div class='row'>
                <div class='col-6'>
                    <button type='submit' id='envoi' class='btn btn-primary' >Envoyer</button>
                </div>
                <div class='col-6'>
                <button type='reset' class='btn btn-primary'> Annuler</button>
                </div>
            </div>
        </form>
        
    </div>


