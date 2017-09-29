<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url();?>assets/imagenes/icon-user.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=$this->session->name;?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="<?php if($activo == 1){ echo "active"; } ?>"><a href="<?php echo base_url();?>buscar_productos"><i class="fa fa-keyboard-o"></i> <span>Productos</span></a></li>
            <li class="<?php if($activo == 5){ echo "active"; } ?>"><a href="<?php echo base_url();?>solicitar_productos"><i class="fa fa-keyboard-o"></i> <span>Solicitar Producto</span></a></li>
            <li class="<?php if($activo == 6){ echo "active"; } ?>"><a href="<?php echo base_url();?>listado_solicitados"><i class="fa fa-keyboard-o"></i> <span>Productos Solicitados</span></a></li>


<!--            <li class="--><?php //if($activo == 2){ echo "active"; } ?><!--"><a href="--><?php //echo base_url();?><!--reportes"><i class="fa  fa-table"></i> <span>Reportes</span></a></li>-->
            <li class="treeview <?php if($activo == 2 || $activo == 3){ echo "active"; } ?>">
                <a href="#"><i class="fa fa-list"></i> <span>Mis Productos</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($activo == 3){ echo "active"; } ?>"><a href="<?php echo base_url();?>mis_productos/<?php echo $this->session->id_empresa; ?>"><i class="fa fa-table"></i>Productos</a></li>
                    <li class="<?php if($activo == 2){ echo "active"; } ?>"><a href="<?php echo base_url();?>agregar_producto"><i class="fa fa-table"></i>Agregar Productos</a></li>
                </ul>
            </li>

<!--            <li class="--><?php //if($activo == 3){ echo "active"; } ?><!--"><a href="--><?php //echo base_url();?><!--Database"><i class="fa fa-database"></i> <span>Database</span></a></li>-->


<!--            <li class="treeview">-->
<!--                <a href="#"><i class="fa fa-link"></i> <span>Catálago</span>-->
<!--                    <span class="pull-right-container">-->
<!--              <i class="fa fa-angle-left pull-right"></i>-->
<!--            </span>-->
<!--                </a>-->
<!--                <ul class="treeview-menu">-->
<!--                    <li><a href="#"><i class="fa fa-circle-o"></i> Categorías</a></li>-->
<!--                    <li><a href="#"><i class="fa fa-circle-o"></i> Marcas</a></li>-->
<!--                </ul>-->
<!--            </li>-->
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
