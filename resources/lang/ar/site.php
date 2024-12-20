<?php
$info=\App\Models\setting::where('name','SiteName')->first()->value;
$com=\App\Models\setting::where('name','cmshn')->first()->value;
$com_real_state = 0.4;
return [
   'siteName' =>$info,
   'city' =>'مدينة',
    'site_all'=>'جرس السوق الكل في',
    'You Welcome IN'=>'مرحبا بك في ',
    'Quick Navigation'=>'تنقل سريع',
    'the walker'=>'الممشى',

    "main"=>"الرئيسية",
    
    "success_payment" => "شكرا لك نقدر تعاملك",

    
    'Fast_navigation' => 'تنقل السريع',
    
    
    'kilo' => 'كيلومتر',

    'footer_app' => 'معروض لتقنيه المعلومات',

'search'=>'البحث',
'more cats'=>'أقسام أكثر....',
'login'=>'الدخول',
'all'=>'الكل',
'Calculation and payment of the site commission'=>'حساب وسداد عموله الموقع',
'maxsize'=>'اقصي حجم للصوره هو 5M',
'Iban'=>'الإيبان',
'If payment is made (mada), the commission will be activated in your account automatically within 24 hours (the transfer form does not need to be filled out)'=>'إذا تم الدفع ( مدى ) يتم تفعيل العمولة بحسابك بشكل تلقائي خلال ٢٤ ساعة (لا يحتاج تعبئة نمودج التحويل )',
'Payment method'=>'طريقة الدفع',
'subscripe method'=>'طريقة الأشتراك',
'You can now subscribe and pay online using the mada network.'=>' يمكنك الان الاشتراك و الدفع عن طريق الموقع بستخدام شبكة مدى.',
'first method'=>'الطريقة الأولى:',
'Mada card'=>'بطاقة مدى',
'The second method :'=>'الطريقة الثانية :',
'Bank transfer'=>'التحويل البنكى',
'Transfer Form'=>'نموذج التحويل',
'Pay by bank transfer to one of the following accounts, then fill in'=>'الدفع بالتحويل البنكي لأحد الحسابات التالية ثم تعبئة',
'And wait a week for activation.'=>'والانتظار اسبوع للتفعيل.',
'commision'=>'عمولة',
'Commission account'=>'حساب العمولة',
'whether the pledge is made for'=>'العمولة أمانة في ذمة المعلن سواء تمت المبايعة عن ',
'The route of the site or because of it, and its value is set out below'=>'طريق الموقع أو بسببه، وموضحة قيمتها بما يلي',
'Sell your product with a commission'=>'بيع منتجك بعمولة',
'just in'=>'فقط فى',
'Enter the selling price'=>'أدخل سعر البيع',
'ryal'=>'ريال',
'Commission payable'=>'العمولة المستحقة',
'Click here to pay with'=>' اضغظ هنا للدفع بـ',
'sent'=>'إرسال',
'enterHere'=>'أضغط هنا',
'for subscripe with'=>'للإشتراك ب',
'About Membership'=>'عن العضوية',
'Membership Advantages'=>'مزايا العضوية',
'MemberShip Conditions'=>'شروط العضوية',
'Do you have any questions or comments?'=>'هل لديك أستفسار أو ملاحظة ؟',
'subscripe now'=>'الأشتراك الأن',
'package prices'=>'أسعار الاشتراكات',
'package'=>'عرض',
'Our client The cream, if the payment is made by (mada) or (Apple Pay), the activation will be done automatically within 24 hours A notification via the site informing you of the acceptance of the process and the subscription'=>'عميلنا الكريم إذا تم الدفع عن طريق (مدى) او (Apple Pay) يتم التفعيل بشكل تلقائي خلال 24 ساعة سيصلك إشعار عبر الموقع يفيدك بقبول العملية و الاشتراك.',
'Subscription and payment by bank transfer.'=>'الاشتراك و الدفع عن طريق التحويلات البنكيه',
'Bank transfers'=>'التحويلات البنكية',
'The second step'=>'الخطوة الثانية',
'The first step'=>'الخطوة الأولى',
'Subscription steps'=>'خطوات الأشتراك',
'Transfer the subscription amount to our bank accounts shown in'=>'قم بتحويل مبلغ الاشتراك على حساباتنا البنكية الموضحة في',
'commission transfer page'=>'صفحة حساب العمولة',
'After transferring the subscription amount, the following form must be completed'=>'بعد تحويل مبلغ الاشتراك، يجب تعبئة النموذج التالي',
'We hope that the information is correct and accurate'=>'نرجو أن تكون المعلومات صحيحة ودقيقه',
'Commission Transfer Form'=>'نموذج تحويل العمولة',
' After sending the amount, you must contact us via the following form in order to register the commission in the name of your membership and then obtain the site is features for customers'=>'بعد إرسال المبلغ يجب عليك التواصل معنا عبر النموذج التالي من أجل تسجيل العمولة باسم عضويتك ومن ثم الحصول على ميزات الموقع للعملاء',
'notes'=>'ملاحظات',
'post number'=>'رقم الإعلان',
'sender name'=>'أسم المحول',
'date transfer'=>'متى تم التحويل',
'username'=>'أسم المستخدم',
'The mobile number associated with your membership '=>'رقم الجوال المرتبط بعضويتك',
'Please ensure that the transfer information is correct and accurate'=>'نرجو الحرص على أن تكون معلومات التحويل صحيحة ودقيقه',
'A copy of the transfer receipt'=>'صورة ايصال التحويل',
'Commission amount'=>'مبلغ العمولة',
'choose'=>'أختر',
'Choose the bank name'=>'أختر أسم البنك',
'Transfer to bank'=>'البنك الذى تم التحويل إلية',
'mobile'=>'رقم الجوال',
'Subscription Transfer Form'=>'نموذج تحويل الأشتراك',
'Subscription Amount'=>'مبلغ الأشتراك',
'Commission amount'=>'مبلغ العمولة',
'pay with mada'=>'الدفع بمدى',
'Clear the log'=>'مسح السجل',
'Add Your Post'=>'اضف اعلانك',

'see more'=>'مشاهدة المزيد',
'add new post'=>'أضافة إعلان جديد',
'choose area'=>'أختر المنطقة',
'choose post type'=>'أختر نوع الأعلان',
'choose type'=>'اختر نوع',
'choose brand'=>'اختار ماركة او اكثر',
'choose up to'=>'(يمكن اختيار الى 3)',
'choose decorations and accessories'=>'اختر الزينة والاكسسوارات المتوفرة',
'choose the spare parts'=>'اختر قطع الغيار المتوفرة',
'area'=>'منطقة',
'upload photos'=>'تحميل الصور',
'continue'=>'إستمرار',
'add photos'=>'اضافة الصور',
'I pledge that all attached pictures are the same item.'=>'أتعهد بأن جميع الصور المرفقة لنفس السلعة.',
'Communicate via private messages'=>'التواصل عبر الرسائل الخاصة',
'Communicate via private messages and responses'=>'التواصل عبر الرسائل الخاصة والردود',
'next post'=>'الأعلان التالى',
'Avoid accepting checks and cash and ensure local bank transfer.'=>'تجنب قبول الشيكات والمبالغ النقدية واحرص على التحويل البنكي المحلي.',
'The advertiser has removed the replies feature.'=>'لقد قام المعلن بإلغاء خاصية الردود.',
'Reply'=>'الرد',
'Write your question for the advertiser here'=>'أكتب سؤالك للمعلن هنا',
'Write your question for the advertiser here'=>'أكتب سؤالك للمعلن',
'follow comment'=>'متابعة الردود',
'in'=>'فى',
'Add to favourites'=>'حفظ',
'Correspondence'=>'مراسلة',
'share'=>'مشاركة',
'share with whatsapp'=>'مشاركة عبر الواتساب',
'report'=>'بلاغ',
'whatsapp'=>'واتساب',
'More privacy and security'=>'أكثر خصوصية وأمان',
'Supports sending pictures and sound'=>'تدعم إرسال الصور والصوت',
'Correspondence in'=>'مراسلة فى',
'Inform the supervisor'=>'ابلاغ المشرف',
'Confirm Report an Undervalue?'=>'تأكيد إبلاغ عن بخس السلعة ؟',
'Front photos of the car'=>'الصور الأمامية للسيارة',
'Car side photos'=>'صور جانب السيارة',
'Photos inside the car'=>'صور داخل السيارة',
'choose post pictures'=>'....أختر صور السلعة',
'Other photos'=>'صور أخرى للسيارة',
'language'=>'لغة',
'setting'=>'الإعدادات',
'logout'=>'تسجيل خروج',

   'post title' => 'عنوان الاعلان', 
'post title en'=>' عنوان الأعلان باللغة الانجليزية :',
'post Type'=>'نوع الأعلان',
'Would you like to set a price?'=>'هل ترغب بتحديد سعر',
'yes'=>'نعم',
'no'=>'لا',
'post text'=>'نص الأعلان',
'required'=>'مطلوب',
'details'=>'تفاصيل الأعلان',
'selected categories'=>'الأقسام المختارة',
'sent post'=>'إرسال الأعلان',
'Click on the following text to edit or add'=>'أنقر على النص التالي للتعديل أو اﻹضافة ',
'Write your specification and item details here'=>'اكتب مواصفات و تفاصيل السلعة هنا',
'Mobile number or method of communication'=>'رقم الجوال او وسيلة التواصل',
'Hide mobile number'=>'إخفاء رقم الجوال',
'choose category'=>'اختر القسم',
'choose model'=>'كل الموديلات',
'You cannot add an ad because:'=>'لايمكنك اضافة اعلان بسبب:',


'You have reached the maximum number of ads during the month'=> 'لقد وصلت للحد الاقصي من الاعلانات',
'You have reached the maximum number of ads during the day'=> 'لقد وصلت للحد الاقصي من الاعلانات',
'Back to main'=>'العودة للرئيسية',
'post location'=>'موقع السلعة',
'concession'=>'تنازل',
'sale'=>'بيع',
'model'=>'الموديل',
'car status'=>'حالة السيارة',
'Used'=>'مستعملة',
'Agency'=>'وكالة',
'Scraping'=>'تشليح',
'Gear type?'=> 'نوع القير',
'The installment side'=>'جهة التقسيط',
'undefined'=>'غير محدد',
'automatic'=>'أوتوماتيك',
'Normal'=>'عادى',
'Fuel type?'=> 'نوع الوقود',
'hybrid'=>'هجين',
'petrol'=>'بنزين',
'diesel'=>'ديزل',
'Double ?'=> 'دبل',
'counter'=>'العداد',
'km'=>'كم',
'profile'=>'الملف الشخصي',
'more'=>'المزيد',
'change language'=>'تغيير اللغه',
'favourites'=>'المحفوظ',
'som_or_price'=>'اختر تحديد السعر او السوم ',
'som'=>'سوم',
'price'=>'سعر',
'you_should_enter_the_price'=>'يجب ادخال السعر سواء سوم او سعر نهائي',
'setting'=>'الأعدادات',
'messages'=>'الرسائل',
'conversations'=>'المحادثات',
'search for user'=>'إبحث عن مستخدم',
'choose conversation'=>'قم بأختيار محادثة',
'del conversation'=>'مسح المحادثة',
'write here'=>'أكتب هنا',
'turn off comments'=>'إيقاف الردود',
'turn on comments'=>'إظهار الردود',
'edit'=>'تعديل',
'delete'=>'حذف',
'update'=>'تحديث',
'update video'=>'تحديث الفيديو',
'Show on map'=>'إظهار على الخريطة',
'Hide off the map'=>'إخفاء من على الخريطة',
'Additional options'=>'خيارات أضافية',
'Pay the commission'=>'دفع العمولة',
'update mobile'=>'تحديث رقم الجوال',
'update password'=>'تغيير كلمة المرور',
'update email'=>'تحديث البريد الألكترونى',
'update username'=>'تغيير مسمى العضوية',
'download as image'=>'تحميل كصورة',
'print'=>'طباعه',
'layout2'=>'التصميم 2',
'layout1'=>'التصميم 1',
'follow'=>'متابعة',
'follower'=>'متابع',
'verify store'=>'توثيق المتجر',
'Show QR'=>'إظهار رمز الQr',
'add_rate'=>'أضف تقييم',
'How was your experience?'=>'كيف كانت تجربتك ؟',
'Example: The goods arrived without delay and men are at the top of morals'=>'مثال: البضاعة وصلت بدون تاخير و الرجال في قمة الاخلاق',
'Do you recommend to deal with it?'=>'هل تنصح بالتعامل معه؟',
'I advise to deal with it'=>'انصح بالتعامل معه',
'I do not advise to deal with it'=>'لا انصح بالتعامل معه',
'Did you buy from the member?'=>'هل قمت بالشراء من العضو؟',
'rate'=>'تقييم',
'similar posts'=>'إعلانات مشابهة',
'conversation'=>'محادثة',
'There are no more posts'=>'لاتوجد اعلانات اكثر',
'There are no simillar posts'=>'لاتوجد اعلانات مشابهه',
'cancel follow'=>'إالغاء المتابعة',
'edit store'=>'تعديل المتجر',
'notifications'=>'الأشعارات',
'del notification'=>'حذف الأشعارات',
'unfollow comment'=>'إلغاء متابعة الردود',
'follow_up'=>'المتابعة',
'Members you follow'=>'أعضاء تتابعهم',
'cancel'=>'إلغاء',
'follow_up_category'=>'أقسام تتابعها',
'posts whose comments you followed'=>'إعلانات قمت بمتابعة تعليقاتها',
'Membership authentication'=>'توثيق العضوية',
'When your account is verified, a sign will appear'=>'عند توثيق حسابك ستظهر علامة',
'Next to the account name'=>'بجانب اسم الحساب',
'Account verification via Absher'=>'توثيق الحساب عبر أبشر',
'Membership verification via Absher'=>'توثيق العضوية عبر أبشر',
'Documentation by adding licenses'=>'توثيق بإضافة التراخيص',
'ID Number'=>'رقم الهوية',
'example'=>'مثال :',
'Send a verification message'=>'إرسال رسالة التحقق',
'Documenting membership and adding licenses'=>'توثيق العضوية و إضافة التراخيص',
'Documenting your membership by linking it to your official information helps protect your membership and increase its credibility.'=>'توثيق عضويتك عبر ربطها بمعلوماتك الرسمية يساعد في حماية عضويتك و زيادة مصداقيتها.',
'Some advertisements for products or services require an official license, and the member must raise the official license through this system. For example, advertising for commenting services requires a commenting license to practice the activity. Anyone who makes announcements about a comment must document his comment license. All official documents are kept in a secure manner and are only available for publication with official government agencies, if requested.'=>'بعض الاعلانات عن منتجات او خدمات يتطلب ترخيص رسمي ويجب ان يقوم العضو برفع الترخيص الرسمي عبر هذا النظام. الاعلان مثلا عن خدمات تعقيب يتطلب رخصة تعقيب لممارسة النشاط. يجب من يقوم بعمل إعلانات عن تعقيب ان يقوم بتوثيق رخصة التعقيب الخاصة به. جميع الوثائق الرسمية يتم حفظها بطريقة آمنة و غير قابلة للنشر سوى مع الجهات الرسمية الحكومية في حال طلبها.',
'Document image'=>'صورة الوثيقة',
'Document Number'=>'رقم المستند',
'Add Documentation'=>'أضافة وثيقة',
'Add membership authentication'=>'أضافة توثيق العضوية',
'Registered Name'=>'الاسم المسجل',
'Post Number'=>'رقم اﻹعلان',
'card number'=>'رقم البطاقة',
'The name as it appears on the card'=>'الأسم كما يظهر على البطاقة',
'Expire Date'=>'تاريخ الأنتهاء',
'Verification code'=>'رمز التحقق',
'The last three numbers on the back of the card'=>'أخر ثلاث ارقام على الوجة الخلفي للبطاقة',
'pay'=>'دفع',
'use'=>'استخدام',
'Use a card registered in the browser'=>'استخدام بطاقة مسجلة في المتصفح',
'updated successfully'=>'تم التحديث بنجاح',
'added successfully'=>'تم الاضافة بنجاح',
'annot rate your self'=>'لا يمكنك تقييم نفسك',
'updated error'=>'لا يمكن تحديث الاعلان قبل 72 ساعة من نشره او تحديثه',
'edit post title en'=>' تعديل العنوان الأنجليزي للأعلان :',
'edit post title'=>'تعديل العنوان العربى للأعلان :',
'edit post description'=>'تعديل نص الأعلان :',
'edit photo'=>'تعديل الصور',
'Add photo'=>'أضافة الصور',
'upload video'=>'رفع الفيديو',
'* The length of the video must not exceed 30 seconds'=>'* طول الفيديو يجب أن لا يتجاوز 30 ثانية',
'Communicate on private'=>'التواصل على الخاص',
'save changes'=>'حفظ التغييرات',
'choose area'=>'أختر المنطقة',
'dashboard'=>'لوحة التحكم',
'store identifier'=>'معرف المتجر',
'identidier'=>'المعرف',
'save'=>'حفظ',
'Enter your phone Number'=>'ادخل رقم الجوال',
'description'=>'Description',
'Locate your store on the map'=>'حدد متجرك على الخريطة',
'phone'=>'رقم الجوال',
'pay commission'=>'ادفع العمولة',
'commission payed'=>'دفع العمولة',
'change'=>'تغيير',
'Your current membership name'=>'اسم عضويتك الحالى',
'update name'=>'تحديث الأسم',
'name'=>'أسم العضوية',
'email'=>'البريد الالكترونى',
'your new email'=>'بريدك الجديد',
'update email'=>'تحديث البريد الألكترونى',
'A confirmation message will be sent to the new mail and an alert will be sent to your mobile number'=>'سيتم ارسال رساله تاكيد الى البريد الالكترونى الجديد',
'change phone number'=>'تغير رقم الجوال',
'current phone number'=> 'رقم الجوال الحالي',
'current phone'=> 'رقم الجوال الجديد',
'The number must be Saudi'=>'يجب ان يكون الرقم سعودي',
'change password'=>'تغيير كلمة المرور',
'confirm password'=>'تأكيد كلمة المرور',
'new password'=>'كلمة المرور الجديدة',
'logout'=>'تسجيل الخروج',
'Sure to log out'=>'متأكد من تسجيل الخروج',
'Create a new account'=>'إنشاء حساب جديد',
'show password'=>'إظهار كلمة المرور',

'Forgot Your Password?'=>'هل نسيت كلمة المرور؟',
'add contact to store'=>'إضافة معلومات اتصال للمتجر',
'close'=>'إغلاق',
'search for post....'=>'إبحث عن سلعة......',
'only new'=>'جديد فقط',
'filtering'=>'تصفية',
'Contact us form'=>'نموذج اتصل بنا',
'contact us'=>'تواصل معنا',
'reason for contact'=>'سبب اتصال',
'message'=>'نص الرسالة',
'photo or video for problem'=>'صورة او فيديو توضح سبب المشكلة',
'choose reason'=>'أختر سبب أتصال',
'E-Mail Address'=>'البريد الألكترونى',
'Password'=>'كلمة المرور',
'Send Password Reset Link'=>'إرسال رابط إعادة تعيين كلمة السر',
'reset password'=>'إعادة تعيين كلمة السر',
'register'=>'تسجيل حساب جديد',
'Confirm password'=>'تأكيد كلمة المرور',
'Tender Deal'=>'إرشادات التعامل',
'search in black list'=>'أبحث فالقائمة السوداء',
'The accounts and mobile numbers of those who misuse the site for forbidden purposes such as cheating, fraud or violating the site’s laws'=>'م حسابات وأرقام جوالات من يقومون بإساءة إستخدام الموقع لأغراض ممنوعه مثل الغش أو الأحتيال أو مخالفة قوانين الموقع',
'check'=>'تحقق',
'Instructions for selling and dealing'=>'إرشادات التعامل والبيع',
'lire'=>'ليرة',
'form in order to register the commission in the name of your membership and then obtain the site is features for customers'=>'من أجل تسجيل العمولة باسم عضويتك ومن ثم الحصول على ميزات الموقع للعملاء',
'The account or mobile number is not in the blacklist'=>'رقم الحساب او الجوال غير موجود في القائمة السوداء',
'The account or mobile number is in the blacklist'=>'رقم الحساب او الجوال موجود فى القائمة السوداء',
'user not found'=>'المستخدم غير موجود',
'copy rights'=>'جميع الحقوق محفوظة لدي ',
'web design'=>'تصميم مواقع',
'app'=>'تطبيقات',
'under work'=>'جارى العمل عليه',
'commission agreement'=>' إتفاقية العمولة',
'continue'=>'إستمرار',

 'pledge_real_state'=>' اتعهد واقسم بالله أنا المعلن أن أدفع عمولة الموقع وهي'.$com_real_state.'% من قيمة البيع سواء تم اليع عن طريق الموقع أو بسببه.',


'note'=>'ملاحظة: عمولة الموقع هي على المعلن ولاتبرأ ذمة المعلن من العمولة إلا في حال دفعها.',
'pledge'=>' اتعهد واقسم بالله أنا المعلن أن أدفع عمولة الموقع وهي'.$com.'% من قيمة البيع سواء تم البيع عن طريق الموقع أو بسببه.',
'will be publish soon'=> 'يمكنكم تحميل التطبيق',
'membership'=> 'الاشتراك السنوي للمتجر',
'also pledge'=>'كما أتعهد بدفع العمولة خلال 10 أيام من استلام كامل مبلغ المبايعة.',
'delete file'=>'تم مسح الملف بنجاح',
'success'=>'تم',
'thousand km'=>'ألف كم',
'link required'=>'حقل رقم الاعلان مطلوب',
'link numeric'=>'رقم الاعلان يجب ان يكون ارقام',
'image required'=>'حقل صورة التحويل مطلوب',
'image image'=>'يجب ادخال صورة فقط',
'image mimes'=>'يجب ان يكون امتداد صورة التحويل احدى الامتدادات التالية:jpg,jpeg,png,svg,gif',
'email required'=>'حقل البريد الالكترونى مطلوب',
'email format'=>'صيغة البريد الالكترونى غير صحيحة',
'phone required'=>'حقل رقم الجوال',
'phone digits between'=>'رقم الجوال يجب ان يكون بين 9 الى 12 رقم',
'image with rate'=>'صورة بالتقييم',
'file image'=>'الملف المدخل يجب ان يكون صورة',
'file extension'=>'امتداد الملف يجب ان يكون :mimes',
'before 28 hours' => 'سيتم اتاحة تعديل الاعلان بعد 72 ساعة من رفع الاعلان',
'warning'=>'تحذير!',
'last update'=>'أخر تحديث',
'edit your area'=>'تعديل الموقع على الخريطة',
'accept terms and condition'=>'الموافقة على الشروط والأحكام',
'sender name required'=>'اسم المحول مطلوب',
'bank name required'=>'البنك المحول علية مطلوب',
'previous post'=>'الأعلان السابق',
'from'=>'من',
'to'=>'إلى',
'year'=>'العام',
'recommend required'=>'من فضلك أختر النصيحة',
'answer required'=>'من فضلك اجب على السؤال',
'loguout message'=>'تم تسجيل الخروج بنجاح',
'login message'=>'تم تسجيل الدخول بنجاح',
'check category id'=>'تأكد من القسم ',
'check area id'=>'تأكد من المدينه',
'Commission Payed Thank You !' => 'تم دفع العمولة شكرا لك',
    'Post Not Exists' => 'رقم المنشور خاطئ',
    'Invalid Post' => 'رقم المنشور خاطئ',
    'Package Not Exists' => 'العضوية غير موجودة',
    'Commented' => 'تم ارسال التعليق',
    'Reply Sent' => 'تم ارسال الرد',
    'Comment Deleted' => 'تم حذف التعليق',
    'Chat Not Found' => 'المحادثة غير موجودة',
    'Chat Deleted' => 'تم حذف المحادثة',
    'error' => 'خطأ',
    'Chat Created' => 'تم انشاء المحادثة',
    'Chat Already Exists' => 'المحادثة موجودة بالفعل',
    'Rate Already Exists' => 'التقييم موجودة بالفعل',
    'number_added_success'=> 'تم اضافة الرقم بنجاح',
    'number_updated_success'=> 'تم تعديل الرقم بنجاح',
    'message sent' => 'تم الارسال',
    'Fav Toggled' => 'تم التبديل',
    'comment_added_body'=>'تم اضافة تعليق جديد علي بوست تتابعه',
    'comment_added'=>'تعليق جديد',
    'Removed From Favourites' => 'تم الحذف من المفضلة',
    'Category unFollowed' => 'تم ازالة المتابعه',
    'Category Followed' => 'تم متابعة القسم',
    'Member Followed' => "تم متابعة العضو" ,
    'Member Unfollowed' => 'تم ازالة المتابعة' ,
    'Post Followed' => 'تم متابعة المنشور',
    'Post UnFollowed' => 'تم ازالة المتابعة',
    'Post Deleted' => 'تم حذف المنشور',
    'Post Updated' => 'تم تحديث المنشور',
    'Post Created' => 'تم اضافة المنشور',
    'Deleted All Notifications' => 'تم حذف جميع التنبيهات',
    'Notification Deleted' => 'تم حذف التنبيه',
    'Updated User Identify' => 'تم تحديث المعرف',
    'Password InCorrect' => 'كلمة السر غير صحيحة',
    'Profile Updated' => 'تم تحديث البيانات',
    'reported' => 'تم الابلاغ',
    'comments toggled' => 'تم تغيير حالة التعليقات',
'user_blocked_before'=>'تم حظر الحساب من قبل',
    'user_blocked_successfully'=>'تم حظر الحساب بنجاح',
    'user_un_blocked_successfully'=>'تم الغاء حظر الحساب بنجاح',
  
    'deleted_successfully'=>'تم الحذف بنجاح',
    
    
     ###################### Start Real state information #################################################################

    'street' => 'نوع الشارع',
    'residential' => 'سكني',
    'commercial' => 'تجاري',
    'space' => 'المساحه',
    'age_of_state' => 'عمر العقار',
    'destination' => 'الواجهه',
    'destination_choose' => 'قم باختيار الواجهه',
    'north' => 'شمال',
    'south' => 'جنوب',
    'east' => 'شرق',
    'west' => 'غرب',
    'southeast' => 'جنوب شرقي',
    'southwest' => 'جنوب غربي',
    'northeast' => 'شمال شرقي',

    'northwest' => 'شمال غربي',
    'three_streets' => 'ثلاث شوارع',
    'four_streets' => 'اربع شوارع',
    'street_width' => 'عرض الشارع',
    'street_width_choose' => 'قم باختيار عرض الشارع',
    'rooms_number' => 'عدد الغرف',
    'number_of_halls' => 'عدد الصالات',
    'number_of_bathrooms' => 'عدد دورات المياه',
    'villa_type' => 'نوع الڤلة',
    'villa_type_choose' =>  'قم باختيار نوع الڤلة',
    'independent' => 'مستقله',
    'duplex' => 'دوبلكس',
    'townhouse' => 'تاون هاوس',
    'with_apartments' => 'مع شقق',
    'additional_options' => 'خيارات اضافيه',
    'additional_options_choose' => 'قم باختيار خيارات اضافيه',
    'equipped_kitchen' => 'مطبخ مجهز',
    'feminine' => 'مؤنث',
    'driver_room' => 'غرفه سائق',
    'maid_room' => 'غرفه خادمه',
    'there_is_a_fireplace' => 'يوجد مشب',
    'appendix' => 'ملحق',
    'car_entrance' => 'مدخل سياره',
    'elevator' => 'مصعد',
    'vault' => 'قبو',
    'air_conditioning' => 'تكييف',
    'swimming_pool' => 'مسبح',
    'drawer' => 'درج',
    'monsters' => 'حوش',
    
    'comment' => 'تعليق',
    'no_comments' => 'لا يوجد تعليقات',
    
    'areas_all' => 'كل المناطق',
    'hay' => 'اختر الحي',
    'search_for_hay' => 'ابحث عن الحي هنا',

    'sub' => 'المشتركين',
    
    'choose_ar' => 'اختر المنطقه',
    'choose_ar_ch' => 'اختر المدينه',


     'elraghy' => 'بنك الراجحي',
     'elraghy_commission' => 'دفع عمولة الموقع',
     
    
    'send_pay' => 'اشترك الان',
    
    'member_create' => 'اضافه عضو جديد',
    
      'reset_password_subject' => 'إعادة تعيين كلمة المرور',
    'reset_password_line1' => 'لقد تلقيت هذا البريد الإلكتروني لأننا تلقينا طلبًا لإعادة تعيين كلمة المرور لحسابك.',
    'reset_password_action' => 'إعادة تعيين كلمة المرور',
    'reset_password_line2' => 'إذا لم تطلب إعادة تعيين كلمة المرور، فلا داعي لاتخاذ أي إجراء آخر.',
    
     'post_placholder' => 'مثال : هوندا اكورد 2017 فول كامل',
    'counter' => 'العداد',
    'price' => "السعر",
    'km' => 'الف كم',
        

      'verfied_code_in_mail' => 'كود تاكيد الدخول',
        'thanks' => 'شكرا لكم',

  

      
     'verify_email_subject' => 'تحقق من عنوان بريدك الإلكتروني',
    'verify_email_greeting' => 'مرحباً!',
    'verify_email_line_1' => 'يرجى النقر على الزر أدناه للتحقق من عنوان بريدك الإلكتروني.',
    'verify_email_button' => 'تحقق من عنوان البريد الإلكتروني',
    'verify_email_line_2' => 'إذا لم تقم بإنشاء حساب، فلا داعي لاتخاذ أي إجراء آخر.',
];
