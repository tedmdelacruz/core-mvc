   <header class="main-header row">

     <div class="span3 pull-right">

       <div class="session-info">
        <?php if ( Auth::isLoggedIn() ): ?>

            Hello, <a href="#"><?php echo $username ?></a> | <a href="<?php echo baseUrl('user/logout') ?>">Logout</a>

        <?php else: ?>

            <a href="<?php echo baseUrl('user') ?>">Example</a> |

            <a href="<?php echo baseUrl('user/login') ?>">Login</a> |

            <a href="<?php echo baseUrl('user/register') ?>">Register</a>

        <?php endif ?>

       </div>

     </div>

   </header>