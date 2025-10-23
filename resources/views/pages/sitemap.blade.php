<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:xhtml="http://www.w3.org/1999/xhtml">';
?>

  <url>
    <loc>https://calculator-logical.com/health/</loc>
  </url>
  <url>
    <loc>https://calculator-logical.com/math/</loc>
  </url>
  <url>
    <loc>https://calculator-logical.com/finance/</loc>
  </url>
  <url>
    <loc>https://calculator-logical.com/everyday-life/</loc>
  </url>
  <url>
    <loc>https://calculator-logical.com/physics/</loc>
  </url>
  <url>
    <loc>https://calculator-logical.com/chemistry/</loc>
  </url>
  <url>
    <loc>https://calculator-logical.com/statistics/</loc>
  </url>
  <url>
    <loc>https://calculator-logical.com/construction/</loc>
  </url> 
  <url>
    <loc>https://calculator-logical.com/pets/</loc>
  </url> 
<url>
    <loc>https://calculator-logical.com/timedate/</loc>
  </url>
<url>
    <loc>https://calculator-logical.com/contact-us/</loc>
  </url>
<url>
    <loc>https://calculator-logical.com/about-us/</loc>
  </url>
<url>
    <loc>https://calculator-logical.com/terms-of-service/</loc>
  </url>
<url>
    <loc>https://calculator-logical.com/privacy-policy/</loc>
</url>
<url>
    <loc>https://calculator-logical.com/content-disclaimer/</loc>
</url>
<url>
  <loc>https://calculator-logical.com/editorial-Policies/</loc>
</url>
<url>
  <loc>https://calculator-logical.com/feedback/</loc>
</url>

<url>
  <loc>https://calculator-logical.com/blog/</loc>
</url>

<?php
    if (isset($posts)){
     
        foreach ($posts as $value) 
        {
            $check=explode('/',$value->post_url);
            if (count($check)==1 && $value->knowledge==0) {
echo "
<url>".
  "
  <loc>".url('blog/'.$value->post_url)."/</loc>
  ";
echo "</url>";
            }else{
               
              $category = strtolower($value->post_cat);
                
echo "<url>".
  "
  <loc>".url($category.'/'.$value->post_url)."/</loc>
  ";
echo "</url>";
            }
        }
    }

    
    if (isset($calculators)){
     
        foreach ($calculators as $value) 
        {
            $check=explode('/',$value->cal_link);
            if (count($check)==1) {
echo "
<url>".
  "
  <loc>".url($value->cal_link)."/</loc>
  ";
if (file_exists("lang/".$value->parent.".txt")) {
    $alter=file_get_contents("lang/".$value->parent.".txt");
    $links=explode('<United-Kingdom>', $alter);
    $links=explode('<li><a class="color_blue" href="',$links[1]);
    foreach ($links as $key => $link) {
        if (!empty($link)) {
            $final=explode('/">', $link);
            $short=str_replace('</a></li>','', $final[1]);
echo '<xhtml:link 
               rel="alternate"
               hreflang="'.strtolower($short).'"
               href="'.$final[0].'/"/>
               ';
        }
    }
}
echo "</url>";
            }
        }
    }

echo "</urlset>";


?>