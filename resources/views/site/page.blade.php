@extends('site.layouts.app')
@section('title')
<title>{{$page->name}}</title>
@endsection

@section('style')

@if(app()->getLocale() == 'en')

<style>
    .container{
        
        direction: ltr;
    }
</style>
@endif
@endsection


@section('content')



<section class="rating-page">
        <div class="container">
            <!--<br>-->
            <!--<button class="backButton btn-link"><svg aria-hidden="true" focusable="false"-->
            <!--    data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x "-->
            <!--    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">-->
            <!--    <path fill="currentColor"-->
            <!--        d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z">-->
            <!--    </path>-->
            <!--</svg></button>-->
            <!--<br>-->
            
            <br><br>
            <a href="javascript:history.back()"class="backButton btn-link">
                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                    </svg>
                    <br>
                </a>
            <?php echo app()->getLocale() == 'ar' ? $page->content : $page->content_en;?>
            <br>
            <br>
            @if(count($page->questions)>0)
            @foreach($page->questions->where('parent_id',null) as $question)
            @if($question->answer !=null)
            <div class="question"><span class="blue" style="cursor: pointer;">{{$question->question}}</span>
                <div class="answer"><?php echo $question->answer;?></div>
            </div>
            @else
            <h1>{{$question->question}}</h1>
            @foreach($page->questions->where('parent_id',$question->id) as $qChild)
            <div class="question"><span class="blue" style="cursor: pointer;">{{$qChild->question}}</span>
                <div class="answer"><?php echo $qChild->answer;?></div>
            </div>
            @endforeach
            @endif
            @endforeach
            @endif
         </div>
</section>
@endsection