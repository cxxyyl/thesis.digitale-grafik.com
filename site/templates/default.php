<?php snippet('head')?>


<?php snippet('searchbar') ?>




<!---------------------------- List of all Klasse Digitale Grafik Thesis Projects ---------------------------->
<!-- This <main> element contains all the theses. You can find all the single theses inside each <article> -->
<!-- But the bulk of the content is inside the <section> inside of the <article>  -->




<main id="content">

  <!-- 
    by: cxxyyl

    ✦ On commenting code and dealing with php ✦
    ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
  
    One of the ideas i had to make the code part of the website more readable was to summarize the information into a neat piece of text. Somewhat of 
    preface to the more fractured nature of information inside the <tags>. Until now I was struggeling with one big problem. I realized, that the PHP Code 
    I write for fetching all the data is leaving behind a somewhat weird formatting and indenting I was never really shure how to feel about. When I write 
    I reeeeaaally want it to be neat and nice looking. And I was wondering how I could achieve something nice looking, or if i should just come to terms with 
    the inherent "look" of using a CMS. 
      But think a found a way to "indent for viewing". It really messes with the code on my (while using VSCode) side, but is helping with readability on your
    end. It's somewhat funny that it seems like there is no way that both of us have nice <em>indented</em> code. One of us will have to deal with messy 
    code and I don't want it to be you. But I am not allowed indent the php code at all, if I do it messes up the spacing. 
      
      ToDo: – find a way to deal with big gaps due to breaks 


    >>> Here is an example – let's have a look at the accordion-container <<<


  ⎾                  ⏋
     This is my view:
  ⎿                  ⏌

            <div class="accordion-container">

              <!- Pursued Degree ->
  <//?php if($item->selectDegree()->isNotEmpty()): ?>
              <p class="accordion-container_degree"></?= $item->selectDegree()?></p>
  <//?php endif?>

               <!- Semester of Publishing ->
              <div class="accordion-container__date">
  <//?php if($item->yearOfPublishing()->isNotEmpty()): ?>
                  <p><//?= $item->yearOfPublishing()?></p>
  <//?php endif?>
  <//?php if($item->semesterCycle()->isNotEmpty()): ?>
                  <p><//?= $item->semesterCycle()?></p>
  <//?php endif?>
              </div>
                  
              <!-  Thesis Author ->
  <//?php $graduate = $item->connectedGraduate()->toPage() ?>
              <h4 class="accordion-container__graduate"><//?=$graduate->name()?> <//?=$graduate->surname()?></h4>
              
               <!- Thesis Title ->
              <h4 class="accordion-container__thesis"><//?= $item->title()?></h4>

            </div>



  ⎾                    ⏋
     This is your view:
  ⎿                    ⏌

            <div class="accordion-container">

              <!- Pursued Degree ->
              <p class="accordion-container_degree">BA</p>

              <!- Semester of Publishing ->
              <div class="accordion-container__date">
                  <p>2019</p>
                  <p>SuSe</p>
              </div>
                  
              <!- Thesis Author ->
              <h4 class="accordion-container__graduate">Test User</h4>
              
              <!- Thesis Title ->
              <h4 class="accordion-container__thesis">This is the Title of a Thesis</h4>
            
            </div>

    -->


  <!-- 
  
    by: cxxyyl
      
    From here on there is a lot of stuff happening that is generated with php/ Kirby. Sadly I'm still not sure how to make that really accessible. 
    Christoph Knoth was talking about using <pre> but then its printed to the Frontend of the Website, which I don't want. But just copieng a commented
    out version is also not THE solutions, because it just cutters everything. I was thinking about using a little symbol? 
  
  -->


<?php snippet('accordion') ?>
</main>

<?php snippet('loadJSModules')?>

<?php snippet('footer')?>

<?php snippet('devlog')?>