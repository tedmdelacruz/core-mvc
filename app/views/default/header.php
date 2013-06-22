   <header class="main-header row">

     <div class="span3 pull-right">

       <div class="session-info">
        <?php if (Auth::is_logged_in()): ?>

            Hello, <a href="#">Admin</a> | <a href="<?php echo base_url('user/logout') ?>">Logout</a>

        <?php else: ?>

            <a href="<?php echo base_url('user/login') ?>">Login</a> |

            <a href="<?php echo base_url('user/register') ?>">Register</a>

        <?php endif ?>
       </div>

     </div>

   </header>