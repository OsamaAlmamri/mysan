<!-- Products content -->

@if(!empty($result['commonContent']['categories']))
<section class="categories-content pro-content">
    <div class="container">
      <div class="products-area">
         <div class="row justify-content-center">
           <div class="col-12 col-lg-6">
             <div class="pro-heading-title">
               <h2> @lang('website.PRODUCT CATEGORIES')
               </h2>
               <p>
                 @lang('website.Categories Text For Home Page')
                </p>
               </div>
             </div>
         </div>
      
      </div>
    </div>
   <div class="row">
    <?php $counter = 0;?>
    @foreach($result['commonContent']['categories'] as $categories_data)
        @if($counter<=7)
        
          <div class="col-12 col-md-6 col-lg-3 cat-banner">
            
            <figure class="categories-image">
              <a href="{{ URL::to('/shop?category='.$categories_data->slug)}}">
                <img class="img-fluid" src="{{asset('').$categories_data->path}}" alt="{{$categories_data->name}}">
                <div class="categories-title">
                  <h3>{{$categories_data->name}}</h3>
                </div>
              </a>
            </figure>

          </div>

        @endif
        <?php $counter++;?>
    @endforeach
   </div>
  </section>
  @endif