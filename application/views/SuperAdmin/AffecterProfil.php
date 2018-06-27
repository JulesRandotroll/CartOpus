<ul class="nav navbar-nav navbar-right">
                        <?php 
                         echo'<li><a href="'.site_url('SuperAdmin/AccueilSuperAdmin').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-user"></span> Page Perso</a></li>';
                             echo'<li><a href="'.site_url('Visiteur/SeDeconnecter').'" style="color:#FFFFFF"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>';
                        ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="row" style="background-color:#15B7D1">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="padding:20px">
            <div style="padding:20px">
                
                    <H1 style="color:#FFFFFF">Affecter un profil à un utilisateur</H1>
                    <section >
                        <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                            <H4>
                                <?php
                                    echo form_open('SuperAdmin/AffecterProfil');

                                    echo form_label('Rechercher :', 'lbl_Recherche');
                                    echo '  ';
                                    echo form_input('MotCle', '', array('placeholder'=>'Rechercher'));
                                    echo '<a href="SuperAdmin/AccueilSuperAdmin" style="color:#000000"><span class="glyphicon glyphicon-search"></span></a></li>';
                                    echo ' ';
                                    // echo '<div class="table-bordered width=100%">';
                                    // echo '<tr><td>';
                                    // echo 'Acteur';
                                    // echo '</td><td>';
                                    // echo '+';
                                    // echo '</table>';
                                    ?>
                                    <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th>Acteur</th>
                                        <th >+</th>
                                        <!--text align right ?? -->
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                       <td>plop</td>
                                      </tr>
                                      <tr>
                                        <td>Mary</td>
                                        <td>Moe</td>
                                       
                                      </tr>
                                      <tr>
                                        <td>July</td>
                                        <td>Dooley</td>
                                   
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <?php
                                    echo form_close();
                                ?>
                                </H4>
                            </div>
                        <section>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
