<?php

class main {

  public function run()
  {
    print (new DateTime())->format('d/m/Y');
  }
}

(new main())->run();

?>