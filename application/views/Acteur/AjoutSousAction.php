<ul class="nav navbar-nav navbar-right">
                        <?php
                          echo '<li class="dropdown">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#FFFFFF ;background-color:#0E7896">Action
                          <span class="caret"></span></a>
                          <ul class="dropdown-menu" style="background-color:#139CBC">
                              <li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>
                              <!-- <li><a href="'.site_url('Acteur/AjoutSousAction/'.$Actions[0]['NOACTION']).'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter SousAction</a></li> !-->
                              <li><a href="'.site_url('Acteur/ChoixAction/1').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-repeat"></span> Renouveler Action</a></li>
                                    <li><a href="'.site_url('Acteur/ChoixAction/2').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-pencil"></span> Modifier Action</a></li>   
                                    <li><a href="'.site_url('Acteur/ChoixAction/3').'" style="color:#FFFFFF ;background-color:#139CBC"><span class="glyphicon glyphicon-trash"></span> Supprimer Action</a></li>
                          </ul>
                  </li>';
                  echo'<li><a href="'.site_url('Acteur/AjoutCollaborateur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> Ajout Collaborateur</a></li>';
                    echo'<li><a href="#" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajout Thématique</a></li>';//'.site_url('Acteur/AjoutThematique/'.$NomAction).'
                            //echo'<li><a href="'.site_url('Acteur/NouvelleAction/0').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-plus"></span> Ajouter Action</a></li>';
                            echo'<li><a href="'.site_url('Acteur/AccueilActeur').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-home"></span> Page Perso </a></li>';
                            echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class='row' style="background-color:#15B7D1;padding:20px">

    <div class='col-sm-2'>
    </div>
    <div class='col-sm-8'>
        <div style="padding:20px">
            <div class = "text-center">
                <H1 align = "center" style="color:#FFFFFF"><?php echo "Ajout d'une sous Action à ".$Actions[0]['NOMACTION'] ;?></H1>
            </div>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php 
                        if(isset($Message))
                        {
                            echo'<div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Attention</strong> '.$Message.'
                                </div>'
                            ;
                        }
                        echo form_open('Acteur/AjoutSousAction/'.$Actions[0]['NOACTION']);
                    ?>
                        <div class='form-group'>
                            <span style="color:#FF0000"/> * </span>
                            <?php 
                                echo form_label('Nom de la sous action : ','lbl_TitreAction');
                                echo form_input('TitreAction',$TitreAction,array('class'=>'form-control','required'=>'required','placeholder'=>'Veuillez saisir le nom de votre sous action'));
                            ?>
                        </div>
                        <div class='row'>
                            <div class='col-xs-4'>
                                <div class='form-group'>
                                    <span style="color:#FF0000"/> * </span>
                                    <?php 
                                        echo form_label('Adresse : ', 'lbl_Adresse');    
                                        echo form_input('Adresse',$Adresse,array('class'=>'form-control','required'=>'required','placeholder'=>'Veuillez saisir l\'adresse de votre sous action'));
                                    ?>
                                </div>
                            </div>
                            <div class='col-xs-4'>
                                <div class='form-group'>
                                    <span style="color:#FF0000"/> * </span>
                                    <?php 
                                        echo form_label('Code Postale : ', 'lbl_CP');    
                                        echo form_input('CP',$CP,array('class'=>'form-control','required'=>'required','placeholder'=>'Veuillez saisir le code postale de votre sous action'));
                                    ?>
                                </div>
                            </div>
                            <div class='col-xs-4'>
                                <div class='form-group'>
                                    <span style="color:#FF0000"/> * </span>
                                    <?php 
                                        echo form_label('Ville : ', 'lbl_Ville');    
                                        echo form_input('Ville',$Ville,array('class'=>'form-control','required'=>'required','placeholder'=>'Veuillez saisir la ville de votre sous action'));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-xs-6'>
                                <div class='form-group'>
                                    <span style="color:#FF0000"/> * </span>
                                    <?php
                                        echo form_label('Date de debut : ', 'dd');
                                        echo '<input class="form-control" name="DateDebut" id="dd" type="date" value="" required>'; 
                                    ?>
                                </div>
                                <div class='form-group'>
                                    <span style="color:#FF0000"/> * </span>
                                    <?php
                                        echo form_label('Heure de debut : ', 'hd');
                                        echo '<input class="form-control" name="HeureDebut" id="hd" type="time" value="" required>'; 
                                    ?>
                                </div>
                                
                            </div>
                            <div class='col-xs-6'>
                                <div class='form-group'>
                                    <?php
                                        echo form_label('Date de fin : ', 'df');
                                        echo '<input class="form-control" name="DateFin" id="df" type="date" value="">'; 
                                    ?>
                                </div>
                                <div class='form-group'>
                                    <?php
                                        echo form_label('Heure de fin : ', 'hf');
                                        echo '<input class="form-control" name="HeureFin" id="hf" type="time" value="">'; 
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class='form-group'>
                            <?php 
                                echo form_label('Description ', 'Desc');
                                echo form_textarea('Description',$Description,Array("placeholder"=>"Ici, votre description",'class'=>'form-control'));
                            ?>
                        </div>
                        <div class='text-center'>
                            <?php
                                echo form_submit('Ajouter','Ajouter',array('class'=>'btn btn-danger btn-lg'));
                            ?>
                        </div>
                    <?php
                        echo form_close();
                    ?>
                </div>
            </section>
        </div>
    </div>
</div>