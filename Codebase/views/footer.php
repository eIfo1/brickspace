      </div>
      </div>
      <footer>
        <div class="row">
          <div class="col-6">
            <div class="links">
              <a href="/support">
                support
              </a>
              <a href="#">
                blog
              </a>
              <a href="#">
                staff
              </a>
            </div>
          </div>
          <div class="col-6">
            <div class="links">
              <?php

              if (!UserAuthenticated()) {
              ?>
                <a href="/login">
                  login
                </a>
                <a href="/register">
                  sign-up
                </a>
              <?php
              } else {
              ?>
                <a href="/logout">
                  logout
                </a>
                <a href="/settings">
                  settings
                </a>
              <?php
              }
              ?>
              <a href="#">
                home
              </a>
            </div>
          </div>
        </div>
        <div class="copyright">
          &copy; 2022 BrickSpace. All Rights Reserved
        </div>
        </div>
      </footer>
      </div>
      </body>
      <!-- scripts -->
      <!-- title -->
      <title>
        <?php
        echo $name;
        ?> // BrickSpace
      </title>

      </html>