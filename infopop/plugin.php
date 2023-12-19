<?php
class infoPop extends Plugin
{

    public function init()
    {

        $this->dbFields = array(
            'color' => '',
            'width' => '',
            'height' => '',
            'content' => '',
            'position' => '',
            'fontcolor' => '',
            'transparent' => '',
            'show' => '',
        );
    }


    public function siteBodyBegin()
    {

        function hex2rgb($hex)
        {
            // Remove the hash if it exists
            $hex = str_replace('#', '', $hex);

            // Make sure the hex code is valid
            if (ctype_xdigit($hex) && (strlen($hex) == 6 || strlen($hex) == 3)) {
                // If it's a 3-character hex code, expand it to 6 characters
                if (strlen($hex) == 3) {
                    $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
                }

                // Convert hex to RGB
                $rgb = array(
                    'r' => hexdec(substr($hex, 0, 2)),
                    'g' => hexdec(substr($hex, 2, 2)),
                    'b' => hexdec(substr($hex, 4, 2))
                );

                return $rgb;
            } else {
                // Invalid hex code
                return false;
            }
        }


        if ($this->getValue('position') == 'bottomleft') {
            echo '<link rel="stylesheet" href="' . $this->domainPath() . 'css/infopopleft.css?v=11">';
        } elseif ($this->getValue('position') == 'bottomright') {
            echo '<link rel="stylesheet" href="' . $this->domainPath() . 'css/infopopright.css?v=22">';
        } elseif ($this->getValue('position') == 'center') {
            echo '<link rel="stylesheet" href="' . $this->domainPath() . 'css/infopopcenter.css?v=33">';
        }

        $rgb = hex2rgb($this->getValue('color'));


        echo '<div class="bulb-content" style="width:' . $this->getValue('width') . ';height:' . $this->getValue('height') . ';background:rgba(' . $rgb['r'] . ',' . $rgb['g'] . ',' . $rgb['b'] . ','.$this->getValue('transparent') .');color:' . $this->getValue('fontcolor') . '">';
        echo '<img src="' . $this->domainPath() . 'img/close.svg" class="toper-close" style="width:24px;filter:invert(100%);">' . html_entity_decode($this->getValue('content')) . '</div>';
    }

    public function siteBodyEnd()
    {
        echo '<script src="' . $this->domainPath() . '/js/infopop.js"></script>';



        if ($this->getValue('show') == 'no') {

            echo '<script>if(localStorage.getItem("closeToperForever")!==null){
                Infopop.style.display="none"}</script>';
        };
    }





    public function form()
    {



        $html = "
        <link rel='stylesheet' type='text/css' href='/bl-plugins/tinymce/css/tinymce_toolbar.css'>
        
    
        
        <p>Width</p>
        <input type='text' name='width' placeholder='example: 100px or 100%' class='form-control' value='" . $this->getValue('width') . "'>
<br>
        <p>Height</p>
        <input type='text' name='height' placeholder='example: 100px or 100%' class='form-control' value='" . $this->getValue('height') . "'>
<br>
        <p>Background</p>
        <input name='color' type='color' class='form-control form-color' value='" . $this->getValue('color') . "'>
<br>
        <p>Background Transparent</p>
        <input name='transparent' type='text' class='form-control form-color' value='" . $this->getValue('transparent') . "' placeholder='0.1 - 1.0'>
        <br>
        <p>Font color</p>
        <input name='fontcolor' type='color' class='form-control form-color' value='" . $this->getValue('fontcolor') . "'>


       <br>
        <p>Position Info Pop</p>
        <select name='position'>
<option value='bottomleft' " . ($this->getValue('position') === "bottomleft" ? "selected" : "") . ">bottom left</option>
<option value='bottomright' " . ($this->getValue('position') === "bottomright" ? "selected" : "") . ">bottom right</option>
<option value='center' " . ($this->getValue('position') === "center" ? "selected" : "") . ">center</option>
        </select>
<br>
        <p>Show after close?</p>
        <select name='show'>
<option value='yes' " . ($this->getValue('show') === "yes" ? "selected" : "") . ">yes</option>
<option value='no' " . ($this->getValue('show') === "no" ? "selected" : "") . ">no</option>

        </select>
<br>
        <p>Content</p>

        <textarea name='content' id='jseditor'>
        " . $this->getValue('content') . "
        </textarea>

      
        
        <div class='bg-danger text-light col-md-12 mt-5 py-3 d-block border text-center'>

      
        <p class='lead'>Created by <b>multicolor</b> | Buy me coffe ❤️  </p>

        <a href='https://www.paypal.com/donate/?hosted_button_id=TW6PXVCTM5A72'>
        <img alt='' border='0' src='https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif'  />
        </a>

        </div>
 


        <script src='/bl-plugins/tinymce/tinymce/tinymce.min.js?version=5.4.1'></script>

        <script>
        tinymce.init({
            selector: '#jseditor',
            auto_focus: 'jseditor',
            element_format : 'html',
            entity_encoding : 'raw',
            skin: 'oxide',
            schema: 'html5',
            statusbar: false,
            menubar:false,
            height:600,
            branding: false,
            browser_spellcheck: true,
            pagebreak_separator: PAGE_BREAK,
            paste_as_text: true,
            remove_script_host: false,
            convert_urls: true,
            relative_urls: false,
            valid_elements: '*[*]',
            cache_suffix: '?version=5.4.1',
            
            plugins: ['code autolink image link pagebreak advlist lists textpattern table'],
            toolbar1: 'formatselect bold italic forecolor backcolor removeformat | bullist numlist table | blockquote alignleft aligncenter alignright | link unlink pagebreak image code',
            toolbar2: '',
            content_css: '/bl-plugins/tinymce/css/tinymce_content.css'
        });
    
        </script>

        ";




        return $html;
    }
}
