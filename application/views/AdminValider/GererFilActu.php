                    <ul class="nav navbar-nav navbar-right">
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="<?php echo js_url('js_GererFilActu'); ?>"></script>

<div class="row" style="background-color:#15B7D1"> 
    <div class="col-sm-2">
    </div> 
    <div class="col-sm-8">
        <div class = "text-center">
            <H1 align = "center" style="color:#FFFFFF">Gestion des favoris</H1><BR>
            <section >
                <div class = "section-inner" style="background-color:#139CBC;padding:20px">
                    <?php 
                        //var_dump($lesActions);
                        echo form_open('AdminValider/ChangerFavoris',array('id'=>'form_favoris'));

                        
                        $this->table->set_heading('Nom','Date Début','Description','Favori');
                        if(!empty($lesActions))
                        {
                            foreach ($lesActions as $uneAction) 
                            {
                                $this->table->add_row($uneAction['NOMACTION'],$uneAction['DATEDEBUT'],$uneAction['Description'],
                                form_checkbox($uneAction['NOACTION'], $uneAction['NOACTION'], $uneAction['Favoris'],array('class'=>'form-control input-sm cbx'))); 
                            }
                        }
                        
                        $Style = array('table_open' => '<table class="table table-responsive">');
                        $this->table->set_template($Style);
                        
                        echo $this->table->generate();
                    
                        echo form_close();
                    ?>
                </div>
            </section>
            <BR>
        </div>
    </div>
    <div class='col-sm-2'>
    </div>
    <br>
</div>