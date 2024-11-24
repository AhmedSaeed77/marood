@extends('site.layouts.app')
@section('title')
<title>@lang('site.Blacklist and Tender Deal')</title>
@endsection
@section('style')
<style>
body{
    background-color: #F2F4FA;
}
</style>
@endsection
@section('content')
@if($page)
    <!--========================== Start checkacc page ==========================-->
    <section class="checkacc-page">
        <div class="container">
           
            <br>
            <a href="javascript:history.back()" class=" btn backButton btn-link new_bg"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg></a>
            <div class="blacklist_header"><img class="blacklist_logo" src="{{url('/')}}/public/site/assets/img/shield.png">
                <div class="content">
                    <h3>@lang('site.search in black list')</h3>
                    <p>@lang('site.The accounts and mobile numbers of those who misuse the site for forbidden purposes such as cheating, fraud or violating the site’s laws')</p>
                </div>
                <form><input id="userSearch" placeholder="رقم الحساب العضو أو رقم الجوال" value=""><button id="searchBlack" class="btn btn-primary-alt" type="button">@lang('site.check')</button>
                     <div class="alert alert-danger" id="short">الرقم قصير جدا</div> 
                </form>
                <div class="card resCard"><h4>رقم الحساب او الجوال غير موجود في القائمة السوداء</h4></div>
            </div>
            @if($page)
            <div class="blacklist_guides">
                <h4>@lang('site.Instructions for selling and dealing')</h4>
                <div class="card">
                <?php echo $page->content?>
                </div>
                <!--<h4>ارشادات البيع والتعامل</h4>-->
                <!--<div class="card">-->
                <!--    <h4>تجنب حالات النصب والاحتيال</h4>-->
                <!--    <p>يفضل التعامل وجهًا لوجه - عند اتباعك لهذه القاعدة فأنت تتجنب 99٪ من محاولات الاحتيال.</p>-->
                <!--    <p>اطلع على تقييمات المعلن وآراء الآخرين حوله وفترة انضمامه للموقع.</p>-->
                <!--    <p>تجنب أعطاء بيانات حسابك في حراج لأي شخص حتى لو ادعى انه من موظفي حراج</p>-->
                <!--    <p>تتم المعاملات بين طرفين فقط، وجود طرف ثالث قد يعني الاحتيال.</p>-->
                <!--    <p>تجنب قبول الشيكات أو المبالغ المالية (الصرف) قبولك لمبالغ مالية مزيفة قد يحملك المسؤولية في البنوك.</p>-->
                <!--    <h4>كيف تعرف المحتال</h4>-->
                <!--    <p>عدم القدرة أو رفض الالتقاء وجهاً لوجه لإتمام الصفقة.</p>-->
                <!--    <p>طلب الدفع أو تحويل الأموال عن طريق Western Union, Paypal</p>-->
                <!--    <p>السؤال عن السلعة بطريقة غريبة.</p>-->
                <!--    <h4>السلامة الشخصية</h4>-->
                <!--    <p>عند مقابلة الطرف الآخر للمرة الأولى تذكر : أن تكون نقطة الالتقاء في مكان (عام مثل: مقهى أو بنك أو مركز تسوق) تجنب الالتقاء به في مكان منعزل، أو دعوته إلى منزلك.</p>-->
                <!--    <p>كن حذرا عند شراء السلع الثمينة.</p>-->
                <!--    <p>أخبر صديقًا أو فردًا من العائلة قبل مقابلتك للطرف الآخر.</p>-->
                <!--    <p>في حالة تعرضك لعملية نصب توجه للجهات الأمنية أو بلغ عبر بوابة كلنا أمن.</p>-->
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif


    <!--========================== End checkacc page ==========================-->

@endsection

@section('script')
<script>
$("#short").hide();
$(".resCard").hide();
$("#searchBlack").on('click',function(){
    var user=$('#userSearch').val();

         $("#short").hide();
    
 $.ajax({
        url:'{{ route('search_user_blackList') }}',
        type:'post',
        data: {
            user : user,
            _token: "{{ csrf_token() }}"
         },success:function(res){
             $(".resCard").text(res);
             $(".resCard").show();
          
            }
        
    });

});

</script>
@endsection