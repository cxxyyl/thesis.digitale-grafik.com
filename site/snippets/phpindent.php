<!-- 
    


  █     ███                                                                                   
  █     ███                                                                              
  ▀▀▀▀▀▀███                                                                        
        ███                                                                     
        ███ ▄   <body></body>
‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾

  ___________________________________
  ✦ Preface – On commenting code and dealing with php ✦
  ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾

  I realized that the PHP code I write for fetching all the data is leaving behind weird formatting and 
  indenting that I was never really sure how to feel about. When I write, I reeeeaaally want it to be neat and nice 
  looking. I was wondering how I could achieve something that looks nice, or if I should just come to terms 
  with the inherent "look" of using a CMS. 

  But I think I found a way to "indent for viewing." It really messes with the code on my side (while using VSCode), 
  but it helps with readability on your end. It's somewhat funny that it seems like there is no way for both of us 
  to have nicely indented code. One of us will have to deal with messy code, and I don't want it to be you.
  However, I am not allowed to indent the PHP code at all – if I do, it messes up the spacing. 

                                                                                                  – cxxyyl

     
      ToDo: 
      – find a way to deal with big gaps due to breaks 
      – why does kirbytext() mess with the html output so much?

                                                  If you should know how to solve these issues, please let me know ♥                                
      



                      
                                                  
    ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ ✦ 
    ✦ ✦ ✦ Here is an example – let's have a look at the accordion-container ✦ ✦ ✦
    ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾


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




  _________
  ✦ On Repetition ✦
  ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
  To be honest, I am really struggling with everything inside of <main></main> – mostly because there 
  is so much programmatic repetition happening because of Kirby. I'm happy that I found a solution for basic
  formatting, but the repetitive nature of everything that follows really sucks! My ideal solution would be to hard
  code everything so that every line of code could be unique. But here we are, stuck with (now ~20x) 270 lines of
  code repeating themselves with minimal (content) differences. Not that this is bad per se, but it sucks that
  every decoration or additional comment will also be repeated so many times that it loses its uniqueness. 
  A potential solution could be a custom script that generates unique textual interjections inside of the
  foreach loop, grabbing them from a text file and inserting them at predefined places. With Kirby, unlisted 
  pages filled with interstitial content could also work. Inserting the content with KirbyText inside of a comment 
  might be a solution. Maybe that’s a thing for the next version of this website.

  The second issue I encountered – and am still thinking about a lot – is how to treat this big repetitive 
  block of code inside of the (let’s call it) narrative structure of this document. In a way, these long-form 
  comments and the code are opposites of each other.       
                                                                      Uniqueness –  Programmatic
                                                                      Secluded   –  Visible
                                                                      Dense      –  Repetitive
    
  As it is generated in one single large block, with a relatively low information density in proportion to the 
  amount of lines it spans, I was wondering a lot about its placement in the larger context of the structure 
  of this document. For now, the version I feel most comfortable with is the one you see right now – with 
  <body></body> being somewhat sandwiched between non-programmatic content. But as I said, I think breaking up 
  the repetitiveness of everything inside the foreach loop could alleviate this issue by increasing the relative 
  information density of content inside <main></main>.

  The third issue I have is that I have not found a really good way to display all the PHP code that 
  generates everything inside of <main></main>. One potential way could be an unlisted page only referenced here, 
  where all the PHP code is treated like above – inside an HTML comment and commented out. Maybe this is 
  also something that will happen in the future. For now, I made the choice not to include all of the PHP code. 
  If that is something interesting for you, there is a public repository of this project on GitHub. 

  With the amount of repetition in general and the nesting of elements, the readability of the HTML inside
  of <main></main> was not that great. Additionally, all the data attributes, IDs, and classes also make the code
  less readable, in my opinion. Going through the code with the inspector tool is a good way to identify what's
  going on and where you are in the code, but my goal is for this side of the website to also work on
  its own, or at least without the additional help of the inspector tool.

  

  


  I tried to improve readability by implementing the following types of helper comments: 


  ⦿ List the key information of each <article></arrticle> as a comment.
  ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
  This is the Article           ✶   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴  ✶
  Info you can see                ̴ ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ  ̴
  before every Article           ̴   ✶                      Article Info                      ✶  ̴
                                  ̴ ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ  ̴
                                ✶   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴  ✶



  ⦿ Comments that describe the contents of the follwoing html elements
  ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾


  ⦿ Layout indicators for a visual reference to the graphic part of the website
  ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
          Layout – Name of element group
          ⎾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ⏋
              ⎾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ⏋



              ⎿ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ⏌
          ⎿ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ⏌







  Christoph Knoth also proposed <pre> but then its printed to the Frontend of the Website, which I don't want.
  Nevertheless a very fun element to play with!
  
  -->