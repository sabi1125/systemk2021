<?php

ob_end_flush();

echo $twig->render($template_filename, $context);