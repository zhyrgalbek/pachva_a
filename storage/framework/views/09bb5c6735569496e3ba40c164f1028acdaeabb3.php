<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center my-3">
            <div class="login-block col-sm-8 col-md-8 col-lg-6 col-xl-6" style="min-width: 375px;">
                <div class="card">
                    <div class="card-header text-center bg-white border-b-0">
                        <h3 class="login-header"><?php echo e(__('Register')); ?></h3>
                        <?php if(session()->has('error')): ?>
                            <p class="alert alert-danger"><?php echo e(__(session('error'))); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('register')); ?>" onsubmit="return validateForm()">
                            <?php echo csrf_field(); ?>
                            <fieldset class="border p-2">
                                <legend class="w-auto"><?php echo e(__('User type')); ?></legend>
                                <div class="input-group">
                                    <?php echo Form::select('user_type', array(
                                        '1' => __('Individual'),
                                        '2' => __('Entity')),
                                        old('user_type') ?: (in_array('entity', array_keys($_GET)) ? 2 : 1),
                                        array('id'=>'user_type', 'required', 'class' => 'form-control'.($errors->has('user_type')?' is-invalid':''),
                                        'data-switcher'
                                    )); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" id="user_type-label" for="user_type">
                                            <i class="fas fa-user-tag"></i>
                                        </label>
                                    </div>
                                    <?php $__errorArgs = ['user_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </fieldset>
                            <fieldset class="border p-2">
                                <legend class="w-auto"><?php echo e(__('User information')); ?></legend>
                                <div class="form-row">
                                    <div class="col-12 mb-3">
                                        <?php echo Form::text('last_name', old('last_name'), array('id'=>'last_name', 'required', 'placeholder' => __('Surname'),'class' => 'form-control'.($errors->has('last_name')?' is-invalid':''))); ?>

                                        <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <?php echo Form::text('name', old('name'), array('id'=>'name', 'required', 'placeholder' => __('Name'),'class' => 'form-control'.($errors->has('name')?' is-invalid':''))); ?>

                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <?php echo Form::text('middle_name', old('middle_name'), array('id'=>'middle_name', 'required', 'placeholder' => __('Middle name'),'class' => 'form-control'.($errors->has('middle_name')?' is-invalid':''))); ?>

                                        <?php $__errorArgs = ['middle_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <?php echo Form::text('identifier', old('identifier'), array('id'=>'identifier', 'required', 'maxlength' => 14, 'placeholder' => __('INN/PIN'),'class' => 'form-control'.($errors->has('identifier')?' is-invalid':''))); ?>

                                        <?php $__errorArgs = ['identifier'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <small id="pinHelp" class="form-text text-muted text-right"><?php echo e(__('PIN will be your login')); ?>, <?php echo e(__('contains 14 digits')); ?></small>
                                    </div>
                                    <div class="col-12 mb-3 orgInput">
                                        <div class="input-group">
                                            <?php echo Form::text('organization_name', old('organization_name'), array('id'=>'organization_name', 'placeholder'=>__('Organization name'), 'class' => 'form-control'.($errors->has('organization_name')?' is-invalid':''))); ?>

                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                                            </div>
                                            <?php $__errorArgs = ['organization_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 emailInput">
                                        <div class="input-group">
                                            <?php echo Form::email('email', old('email'), array('id'=>'email', 'placeholder' => __('E-Mail Address'),'class' => 'form-control'.($errors->has('email')?' is-invalid':''))); ?>

                                            <div class="input-group-append">
                                                <label class="input-group-text" id="email-label" for="email"><i
                                                            class="fas fa-envelope"></i></label>
                                            </div>
                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            <?php echo Form::text('phone', old('phone'), array('id'=>'phone', 'required',  'maxlength' => '13' , 'placeholder' => '996 700 000 000','class' => 'form-control'.($errors->has('phone')?' is-invalid':''))); ?>

                                            <div class="input-group-append">
                                                <label class="input-group-text" id="phone-label" for="phone"><i class="fas fa-phone"></i></label>
                                            </div>
                                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            <?php echo Form::password('password', array('value'=> old('password'), 'id'=>'password', 'required', 'placeholder' => __('Password'),'class' => 'form-control'.($errors->has('password')?' is-invalid':''))); ?>

                                            <div class="input-group-append">
                                                <label class="input-group-text" id="password1-label" for="password1"><i class="fas fa-lock"></i></label>
                                            </div>
                                        </div>
                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger" role="alert">
                                                <strong><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            <?php echo Form::password('password_confirmation', array('value'=> old('password_confirmation'), 'id'=>'password_confirmation', 'required', 'placeholder' => __('Confirm Password'),'class' => 'form-control'.($errors->has('password_confirmation')?' is-invalid':''))); ?>

                                            <div class="input-group-append">
                                                <label class="input-group-text" id="password_confirmation-label"
                                                       for="password_confirmation"><i
                                                            class="fas fa-unlock"></i></label>
                                            </div>
                                            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <!-- <div class="col-12 mb-3">
                                      <div class="ps-4">
                                          <input type="checkbox" id="process_personal_data" name="process_personal_data" class="form-check-input" required>
                                          <label class="form-check-label" for="process_personal_data">
                                              <?php echo e(__('Permission to process personal data')); ?>

                                              <a class="form-text2 mb-3 mt-n2" data-toggle="modal" data-target="#exampleModalCenter">
                                                  <?php echo e(__('Public offer')); ?>

                                              </a>
                                              <?php echo e(__('And allow')); ?>

                                              <a class="form-text2 mb-3 mt-n2" data-toggle="modal" data-target="#exampleModalCenter2">
                                                  <?php echo e(__('Public offer2')); ?>

                                              </a>
                                          </label>
                                          <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                          <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                      </div>
                                    </div> -->

                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            <div id="captcha-container" class="w-100 d-flex justify-content-center
                                            <?php echo e($errors->has('g-recaptcha-response')?'is-invalid':''); ?>">
                                                <?php echo NoCaptcha::display(['data-callback'=>'captching']); ?>

                                            </div>
                                            <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <a class="form-text mb-3 mt-n2" href="https://pochva.24mycrm.com">
                                        <?php echo e(__('I am already registered')); ?>

                                    </a>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <?php echo e(__('Register')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page-scripts'); ?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl moda" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Пользовательское соглашение (Публичная оферта)
                        Автоматизированной информационной системы «Складские свидетельства» (Sklads.kg)
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Пользовательское соглашение Сайта платформы (далее – Пользовательское соглашение) представляет собой публичную оферту в соответствии со 2 пунктом 398 статьи Гражданского кодекса Кыргызской Республики,  Лицо, приступившее к использованию Сайта платформы (далее – Пользователь), считается подтвердившим свое согласие с условиями настоящего  Пользовательского соглашения.<br><br>
                    Использование Сайта платформы Пользователем означает, что Пользователь принимает и обязуется соблюдать все нижеприведенные условия настоящего Соглашения.<br><br>
                    АИС «Складские свидетельства» предназначена для обеспечения бездокументарного оборота складских свидетельств, согласно требований закона «О товарных складах и складских свидетельствах» <a href="http://cbd.minjust.gov.kg/act/view/ru-ru/111772">http://cbd.minjust.gov.kg/act/view/ru-ru/111772.</a> <br><br>
                    АИС «Складские свидетельства» предполагается использовать для обеспечения электронного взаимодействия между участниками электронного обращения складских свидетельств:<br>
                    o	Клиент (владелец товара, держатель складского свидетельства);<br>
                    o	Товарный склад (инициирует выпуск и погашение складского свидетельства);<br>
                    o	Коммерческий банк/Микрофинансовая организация (акцептует складское свидетельство для залога и подтверждает снятие с залога).<br><br>

                    АИС «Складские свидетельства» был создан с целью:<br><br>
                    - Регистрации в системе пользователей участников взаимодействия АИС «Складские свидетельства»;<br><br>
                    - Обеспечения сбора перечня документов, согласно Положению о порядке ведения реестра товарных складов <a href="http://cbd.minjust.gov.kg/act/view/ru-ru/14986?cl=ru-ru">http://cbd.minjust.gov.kg/act/view/ru-ru/14986?cl=ru-ru,</a>  для первичной обработки (экспертизы) исходной информации со стороны Уполномоченного государственного органа в лице Министерства сельского хозяйства Кыргызской Республики (МСХ КР), необходимой для регистрации складов в Едином государственном реестре товарных складов;<br><br>
                    - Обеспечения функционала регистрации складских свидетельств товарными складами, согласно Положению о порядке ведения реестра складских свидетельств <a href="http://cbd.minjust.gov.kg/act/view/ru-ru/14985?cl=ru-ru">http://cbd.minjust.gov.kg/act/view/ru-ru/14985?cl=ru-ru</a>   и подтверждение внесения в Единый государственный реестр простых и двойных складских свидетельств уполномоченным государственным органом в сфере регулирования рынка ценных бумаг в лице Государственной службы регулирования и надзора за финансовым рынком при Министерстве экономики и коммерции КР (Финнадзор);<br><br>
                    - Предоставления функционала для владельцев складских свидетельств по проверке статуса принадлежащих владельцу свидетельств, инициации действий со свидетельствами по залогу, передачи прав, погашению и других действий;<br><br>
                    - Создания единых реестров товарных складов и реестра складских свидетельств с возможностью поиска склада или свидетельства по QR-коду или ссылке;<br><br>
                    -  Обеспечения единой платформы для обращения складских свидетельств в Кыргызской Республике;<br><br>
                    -  Предоставление стандартизированного решения для всех участников рынка складских свидетельств для упрощения обращения складских свидетельств и минимизации расходов для всех участников.<br><br>
                    Администрация <strong>Sklads.kg </strong>оставляет за собой право вносить в Соглашение изменения, которые вступают в силу с момента публикации. Текст действующей редакции Соглашения всегда доступен по адресу https://sklads.kg/register.<br><br>
                    Дальнейшее использование вами <strong>Sklads.kg </strong> означает ваше согласие с ними.<br><br>

                    <strong>Основные термины</strong><br><br>
                    Сайт платформы – совокупность размещенных в сети электронных документов (файлов), объединенных единой темой, дизайном и единым адресным пространством домена <strong>sklads.kg.</strong> Стартовая страница Сайта размещена в сети Интернет по адресу https://sklads.kg/.<br><br>
                    <strong>Пользователь Сайта</strong> (Пользователь) – лицо, прошедшее Процедуру регистрации, предварительно выбравший свой тип пользователя: а) Фермер; б) Склад и получившее индивидуальный логин и пароль, а также в последующем имеющее свой Профиль.<br>
                    Для прохождения первичной регистрации Пользователя, необходимо заполнить регистрационную форму по адресу: https://sklads.kg/register  и предоставить следующие данные:<br><br>
                    •	Фамилия, Имя, Отчество,<br>
                    •	Дата рождения,<br>
                    •	ИНН/ПИН (14 цифр с паспорта),<br>
                    •	Наименование своей организации (для физических лиц ФИО, для юридических лиц полное наименование ИП, СК, ОсОО и тп.),<br>
                    •	Электронную почту/email,<br>
                    •	Телефон, на который направляется СМС со ссылкой для подтверждения номера телефона,<br>
                    •	Пароль и его повторное подтверждение.<br><br>
                    Для целей Пользовательского соглашения под Пользователем понимается также лицо, которое не прошло Процедуру регистрации, но осуществляет доступ к Сайту и/или использует и/или использовало его. Любое лицо, осуществляющее доступ к Сайту платформы, этим автоматически подтверждает, что оно полностью согласно с положениями Пользовательского соглашения, и что в отношении него применимы требования, установленные Пользовательским соглашением.<br><br>
                    <strong>Администрация Сайта платформы</strong> (Администрация) – ОЮЛ «Союз банков Кыргызстана», которому принадлежат все соответствующие имущественные права на Сайт платформы, включая права на доменное имя Сайта (https://sklads.kg/), и осуществляющее его администрирование.<br><br>
                    <strong>Учетная запись пользователя</strong> (Аккаунт) – интернет-пространство, защищенное паролем. Содержит информацию о пользователе и Контент, сгенерированный Пользователем. Учетная запись содержит личные и контактные данные Пользователя, включая, но не ограничиваясь, такими как электронный адрес, род деятельности, вид товара на хранении товарного склада внесенный в соответствующий реестр и другое.<br><br>
                    <strong>Контент</strong> – любое информационно-значимое наполнение информационного ресурса, в том числе в виде данных о своей деятельности, объемов продукции, текстов, возможных анонсов и прочих материалов.<br><br>
                    <strong>1. Предмет Пользовательского соглашения</strong><br>
                    1.1. Настоящее Пользовательское соглашение (далее Соглашение) является юридически обязывающим договором между Sklads.kg и Пользователем и регламентирует использование услуг Sklads.kg. Пользователем признается лицо, надлежащим образом присоединившееся к настоящему Соглашению.<br><br>
                    1.2. Текст Соглашения выводится Пользователю при регистрации на сайте https://sklads.kg/ (далее Сайт). Соглашение вступает в силу с момента выражения Пользователем согласия с его условиями путем прохождения регистрации и действует в течение всего времени предоставления и использования услуг.<br><br>
                    <strong>2. Ограничение ответственности Администрации</strong><br><br>
                    2.1. Администрация прилагает все возможные усилия для того, чтобы исключить с Сайта небрежную, неаккуратную, оскорбительную, не соответствующую действительности или заведомо неполную информацию, однако, в конечном счете, ответственность за нее лежит на разместивших ее лицах.<br><br>
                    2.2. Администрация не отвечает за то, что зарегистрированные пользователи являются действительно теми людьми, за кого себя выдают, и не несет ответственности за возможный ущерб, причиненный другим лицам.<br><br>
                    2.3. Пользователь уведомлен и согласен с тем, что не имеет право предъявлять претензии к Администратору в случае не указания при регистрации своих персональных данных, либо указания персональных данных, не соответствующих данным, обозначенным в гражданском паспорте.<br><br>
                    2.4. Ни при каких обстоятельствах Администратор не несет ответственность перед Пользователем или любыми третьими лицами за любой прямой, косвенный, неумышленный ущерб, включая упущенную выгоду или потерянные данные, вред чести, достоинству или деловой репутации, вызванные в связи с использованием Сайта или результатов интеллектуальной деятельности, размещенных на Сайте.<br><br>
                    2.5. Администратор не несет ответственности перед Пользователем или любыми третьими лицами за:<br><br>
                    - действия Пользователя на Сайте;<br><br>
                    - за содержание и законность, достоверность информации, используемой/получаемой Пользователем на Сайте;<br><br>
                    - за достоверность рекламной информации, используемой/получаемой Пользователем на Сайте, и качество рекламируемых в ней товаров/работ/услуг;<br><br>
                    - за последствия применения информации, используемой/получаемой Пользователем на Сайте;<br><br>
                    2.6. В случае предъявления третьими лицами претензий к Администратору, связанных с использованием Пользователем Сайта, Пользователь обязуется своими силами и за свой счет урегулировать указанные претензии с третьими лицами, оградив Администратора от возможных убытков и разбирательств.<br><br>
                    <strong>3. Администрация имеет право:</strong><br><br>
                    3.1. В любое время изменять оформление Сайта, его Контент, список сервисов, изменять или дополнять используемое программное обеспечение и другие объекты, используемые или хранящиеся на Сайте;<br><br>
                    3.2. При необходимости отправлять Пользователям по электронной почте сообщения, касающиеся использования Сайта;<br><br>
                    3.3. Изменять (модерировать) или удалять любой Контент, нарушающий настоящее Соглашение, а также приостанавливать, ограничивать или прекращать доступ Пользователя ко всем или к любому из разделов или сервисов Сайта с предварительным уведомлением или без такового.<br><br>
                    <strong>4. Пользователь имеет право:</strong><br><br>
                    4.1. Размещать Контент, не противоречащий данному Соглашению, после подтверждения номера мобильного телефона;<br><br>
                    4.2. Обращаться к Администрации Сайта с целью разрешения спорных вопросов;<br><br>
                    4.3. Бесплатно пользоваться всем информацией сайта, в личный целях.<br><br>
                    <strong>5. Пользователь обязуется:</strong><br>
                    5.1. Принимать надлежащие меры для обеспечения сохранности личного логина и пароля для доступа к Сайту;<br><br>
                    5.2. Регулярно знакомиться с содержанием настоящего Соглашения, в целях своевременного ознакомления с его изменениями.<br><br>
                    5.3. Нести полную ответственность за любые действия, совершенные Пользователем с использованием его Аккаунта, а также за любые последствия, которые могло повлечь или повлекло подобное его использование;<br><br>
                    5.4. Пользователь, используя тот или иной раздел Сайта, обязуется соблюдать правила пользования этим разделом сайта, если таковые существуют и описаны в этом разделе.<br><br>
                    5.5. Используя информацию с Сайта, Пользователь осознает и принимает риски, связанные с ее возможной недостоверностью, а также с тем, что некоторая информация может показаться ему угрожающей, заведомо ложной, грубой, непристойной. Если это произошло, Пользователь должен немедленно сообщить Администрации о наличии подобной информации.<br><br>
                    <strong>6. Настоящим Соглашением на Сайте запрещается:</strong><br><br>
                    6.1. Размещать любую рекламу, за исключением случаев, санкционированных Администрацией Сайта, а также в рамках сервисов размещения коммерческих объявлений и рекламы, предоставляемых Сайтом на условиях, оговариваемых отдельно;<br><br>
                    6.2. Размещать коммерческие предложения, агитационные материалы, распространять спам, любую другую навязчивую информацию;<br><br>
                    6.3. Размещать любую информацию, нарушающую права пользователей или третьих лиц на объекты интеллектуальной собственности;<br><br>
                    6.4. Домогаться, притеснять, оскорблять, назойливо преследовать или иначе злонамеренно доставлять беспокойство любому физическому или юридическому лицу, пользователю сайта;<br><br>
                    6.5. Запрещается двойная регистрация (два и более ников). В случае выявления подобного факта, администрация оставляет за собой право заблокировать ее без предупреждения и вынести наказание для основного ника посетителя.<br><br>
                    6.6. Загружать, публиковать и передавать иным способом следующий Контент:<br><br>
                    6.6.1. незаконный;<br><br>
                    6.6.2. оскорбительный по отношению к другим пользователям и третьим лицам;<br><br>
                    6.6.3. вульгарный, непристойный, порнографического характера;<br><br>
                    6.6.4. служебного характера или не подлежащий разглашению;<br><br>
                    6.6.5. нарушающий права третьих лиц;<br><br>
                    6.6.6. рекламного характера;<br><br>
                    6.6.7. содержащий угрозы, клеветническую, дискредитирующую информацию;<br><br>
                    6.6.8. носящий мошеннический характер;<br><br>
                    6.6.9. пропагандирующий расовую, религиозную, этническую ненависть или вражду, любую иную информацию, нарушающую охраняемые законом права человека и гражданина.<br><br>
                    <strong>7. Права на Контент, размещенный на Сайте</strong><br><br>
                    7.1. Все используемые и размещенные на Сайте результаты интеллектуальной деятельности, а также сам Сайт являются интеллектуальной собственностью их законных правообладателей и охраняются законодательством об интеллектуальной собственности Кыргызской Республики, а также соответствующими международными правовыми конвенциями.<br><br>
                    7.2. Никакой Контент не может быть скопирован (воспроизведен), переработан, распространен, отображен во фрейме, опубликован, скачан, передан, продан или иным способом использован целиком или по частям, без предварительного разрешения правообладателя, кроме случаев, когда правообладатель явным образом выразил свое согласие на свободное использование материала любым лицом, за исключением случаев, установленных настоящим Соглашением, а также действующим законодательством Кыргызской Республики;<br><br>
                    7.3. Использование Контента, к которому Пользователь получил доступ исключительно для личного использования, допускается при условии сохранения всех знаков авторства (копирайтов) или других уведомлений об авторстве, сохранения имени автора в неизменном виде, сохранении произведения в неизменном виде.<br><br>
                    7.4. Все материалы, права на которые принадлежат Администрации Сайта Sklads.kg, могут быть воспроизведены в любых средствах массовой информации, на серверах сети Интернет или на любых иных носителях без каких-либо ограничений по объему и срокам публикации. Это разрешение в равной степени распространяется на газеты, журналы, радиостанции, телеканалы, сайты и страницы сети Интернет. Единственным условием перепечатки и ретрансляции является прямая ссылка на первоисточник https://sklads.kg/. Предварительного согласия на перепечатку со стороны издателей или авторов Сайта не требуется.<br><br>
                    7.5. Для Интернет-ресурсов обязательным условием любого вида цитирования является размещение активной прямой гиперссылки на первоисточник https://sklads.kg, в конце материала.<br><br>
                    7.6. При воспроизведении материалов не допускается переработка их оригинального текста. Сокращение или перекомпоновка частей материала допускается, но только в той мере, в какой это не приводит к искажению его смысла.<br><br>
                    Также, ни при каких обстоятельствах информационный сайт Sklads.kg, не несет ответственности перед физическими и юридическими лицами за любые убытки, полностью или частично причиненные в результате использования данных Сайта.<br><br>
                    <strong>8. Заключительные положения</strong><br><br>
                    8.1. Настоящее Соглашение представляет собой публичную оферту, в соответствии со 2 пунктом 398 статьи Гражданского кодекса Кыргызской Республики. Согласие Пользователя с условиями настоящего Соглашения (акцептом) считается фактическое пользование Сайтом, его сервисами и результатами интеллектуальной деятельности размещенными на нем.<br><br>
                    8.2. Пользователь и Администрация Сайта будут пытаться решить все возникшие между ними споры и разногласия путем переговоров. В случае невозможности разрешить споры и разногласия путем переговоров они подлежат рассмотрению в соответствующем суде по месту нахождения Администрации Сайта.<br><br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl moda" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Политика обработки персональных данных
                        Системы Sklads.kg
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>1. Общие положения</strong> <br>
                    1.1.В целях выполнения норм действующего законодательства Кыргызской Республики в полном объеме ОЮЛ «Союз банков Кыргызстана» (далее – Оператор) считает важнейшими своими задачами соблюдение принципов законности, справедливости и конфиденциальности при обработке персональных данных, а также обеспечение безопасности процессов их обработки.<br>
                    1.2.Настоящая политика Оператора в отношении организации обработки и обеспечения безопасности (далее – Политика) характеризуется следующими признаками:<br>
                    1.2.1. Разработана в целях реализации требований законодательства Кыргызской Республики в области обработки персональных данных субъектов персональных данных;<br>
                    1.2.2. Раскрывает способы и принципы обработки Оператора персональных данных, права и обязанности Оператора при обработке персональных данных, права субъектов персональных данных, а также включает перечень мер, применяемых в целях обеспечения безопасности персональных данных при их обработке;<br>
                    1.2.3. Является общедоступным документом, декларирующим концептуальные основы деятельности Оператора при обработке и защите персональных данных.<br>
                    1.3. Оператор добросовестно и в соответствующий срок осуществляет актуализацию сведений, указанных во внутренних документах Оператора Системы Sklads.kg.<br><br>
                    <strong>2. Правовые основания обработки персональных данных</strong><br>
                    2.1.Политика Оператора в отношении организации обработки персональных данных определяется в соответствии со следующими нормативными правовыми актами Кыргызской Республики:<br>
                    2.1.1.Конституцией Кыргызской Республики;<br>
                    2.1.2.Трудовым кодексом Кыргызской Республики;<br>
                    2.1.3.Гражданским кодексом Кыргызской Республики;<br>
                    2.1.4.Законом Кыргызской Республики «Об информации персонального характера».<br><br>

                    <strong>3. Принципы, цели, содержание и способы обработки персональных данных</strong><br>
                    3.1. Оператор в своей деятельности обеспечивает соблюдение принципов обработки персональных данных, указанных в Статье 4. Закона Кыргызской Республики «Об информации персонального характера», от 14 апреля 2008 года № 58.<br>
                    3.2. Оператор осуществляет сбор и дальнейшую обработку персональных данных в следующих целях:<br>
                    3.2.1. Предоставление посетителям сайта <a href="https://sklads.kg">https://sklads.kg</a>  сервисов для регистрации Пользователей в лице а) Фермеров; б) Складов.<br>
                    3.2.2. Формирования и подачи в Уполномоченный государственный орган, в лице Министерства сельского хозяйства Кыргызской Республики (МСХ КР), соответствующей заявки со стороны товарного склада, согласно Порядка рассмотрения документов товарных складов Положения о порядке ведения Единого государственного реестра товарных складов (Реестр складов) <a href="http://cbd.minjust.gov.kg/act/view/ru-ru/14986?cl=ru-ru.">http://cbd.minjust.gov.kg/act/view/ru-ru/14986?cl=ru-ru.</a> <br>
                    3.2.3. Обеспечения функционала регистрации складских свидетельств товарными складами, согласно Положению о порядке ведения реестра складских свидетельств <a href="http://cbd.minjust.gov.kg/act/view/ru-ru/14985?cl=ru-ru">http://cbd.minjust.gov.kg/act/view/ru-ru/14985?cl=ru-ru</a>   и подтверждение внесения в Единый государственный реестр простых и двойных складских свидетельств (Реестр складских свидетельств) уполномоченным государственным органом в сфере регулирования рынка ценных бумаг, в лице Государственной службы регулирования и надзора за финансовым рынком при Министерстве экономики и коммерции КР (Финнадзор).<br>
                    3.2.4.   Ведение учета количества Пользователей Системой Sklads.kg.<br>
                    3.2.5. Осуществление взаимодействия между Фермерами, Товарными складами внесенными в Единый государственный реестр товарных складов, МСХ КР, Финнадзором, Банками/Микрофинансовыми организациями.<br>
                    3.2.12.  Осуществление отчетности, предусмотренные законодательством Кыргызской Республики.<br>
                    3.3. Оператор установил следующие сроки и условия прекращения обработки персональных данных:<br>
                    3.3.1.Предоставление субъектом персональных данных или его законным представителем сведений, подтверждающих, что персональные данные являются незаконно полученными или не являются необходимыми для заявленной цели обработки – в течение 7 дней.<br>
                    3.3.4.Невозможность обеспечения правомерности обработки персональных данных – в течение 10 дней.<br>
                    3.3.5.Отзыв субъектом персональных данных согласия на обработку персональных данных, если сохранение персональных данных более не требуется для целей обработки персональных данных – в течение 30 дней.<br>
                    3.4.Обработка персональных данных Оператором включает в себя сбор, запись, систематизацию, накопление, хранение, уточнение (обновление, изменение), извлечение, использование, передачу (распространение, предоставление, доступ), обезличивание, блокирование, удаление, уничтожение персональных данных.<br>
                    3.5. Оператор не осуществляет обработку биометрических персональных данных (сведения, которые характеризуют физиологические и биологические особенности человека, на основании которых можно установить его личность).<br>
                    3.6. Оператор не выполняет обработку специальных категорий персональных данных, касающихся расовой, национальной принадлежности, политических взглядов, религиозных или философских убеждений, состояния здоровья, интимной жизни.<br>
                    3.7. Оператор не производит трансграничную (на территорию иностранного государства органу власти иностранного государства, иностранному физическому лицу или иностранному юридическому лицу) передачу персональных данных.
                    3.8. Оператором создаются общедоступные источники данных (Реестр товарных складов и Реестр складских свидетельств) согласно Положениям о порядке ведения Единых государственных реестров (см. выше). Персональные данные, сообщаемые субъектом (фамилия, имя, отчество, ИНН/ПИН, наименование занимаемой должности, контактные данные и др.), размещаются не в публичном доступе, доступ к которым имеют только Уполномоченный государственный орган в сфере сельского хозяйства и Уполномоченный государственный орган в сфере регулирования рынка ценных бумаг (Уполномоченные органы).<br>
                    3.9. Оператором не принимаются решения, порождающие юридические последствия в отношении субъектов персональных данных или иным образом затрагивающие их права и законные интересы, на основании исключительно автоматизированной обработки их персональных данных.<br>
                    3.10. Оператор осуществляет обработку персональных данных с использованием средств автоматизации и без использования средств автоматизации с вовлечением в данный процесс Уполномоченных органов.<br><br>
                    <strong>4 . Классификация персональных данных и Субъектов персональных данных</strong><br><br>
                    4.1. К персональным данным относится любая информация, относящаяся к прямо или косвенно определенному или определяемому физическому лицу (Субъекту персональных данных), обрабатываемая Организацией для достижения заранее определенных целей.<br>
                    4.2. Организация не осуществляет обработку специальных категорий персональных данных, касающихся расовой и национальной принадлежности, политических взглядов, религиозных и философских убеждений, состояния здоровья, интимной жизни и судимости физических лиц.<br>
                    4.3. Организация осуществляет обработку персональных данных следующих категорий Субъектов персональных данных:<br>
                    а)  физические либо юридические лица, осуществляющие деятельность по производству, переработке, хранению, экспорту и др., сельскохозяйственной или иной продукции;<br>
                    б) физические лица, являющиеся ответственными пользователями сервиса Sklads.kg от лица уполномоченного лица по ведению Реестра складов и Реестра складских свидетельств;<br>
                    в) физические лица, персональные данные которых сделаны ими общедоступными, а их обработка не нарушает их прав и соответствует требованиям, установленным в Положениях о порядке ведения Единых государственных реестров;<br><br>
                    <strong>5. Обеспечение безопасности персональных данных</strong><br><br>
                    Оператор при обработке персональных данных принимает все необходимые меры для их защиты от неправомерного или случайного доступа, уничтожения, изменения, блокирования, копирования, предоставления, распространения, а также от иных неправомерных действий в отношении них. Обеспечение безопасности персональных данных достигается, в частности, следующими способами:<br>
                    5.1. Важнейшим обязательным условием реализации целей деятельности Организации является обеспечение необходимого и достаточного уровня защищенности, а также соблюдение конфиденциальности, целостности и доступности обрабатываемых персональных данных на всех этапах работы с ними.<br>
                    5.2. Организация обеспечивает режим защиты персональных данных, соответствующий первому уровню защищенности персональных данных.
                    5.3. Обеспечение безопасности обрабатываемых персональных данных осуществляется с применением мероприятий по защите информации, с учетом требований Законодательства о персональных данных.<br>
                    5.4. В целях организации и обеспечения безопасности персональных данных Организация обеспечивает следующие меры:<br>
                    • строгое ограничение круга лиц, имеющих доступ к персональным данным;
                    • ознакомление работников с требованиями законодательства и нормативных документов Оператора по обработке и защите персональных данных;<br>
                    • обеспечение учёта и хранения материальных носителей персональных данных в условиях, обеспечивающих сохранность и недопущение несанкционированного доступа к ним;<br>
                    • регулярная оценка и определение угроз безопасности персональных данных при их обработке в информационных системах персональных данных;<br>
                    • учёт действий пользователей информационных систем персональных данных;
                    • применение средств разграничения и контроля доступа к информации, информационным ресурсам, информационным системам, коммуникационным портам, устройствам ввода-вывода информации, съёмным машинным носителям и внешним накопителям информации;<br>
                    • реализация парольной защиты при осуществлении доступа пользователей к информационной системе персональных данных;<br>
                    • осуществление антивирусного контроля, предотвращение внедрения вредоносных программ (программ-вирусов) и программных закладок;<br>
                    • обнаружение вторжений;<br>
                    • резервное копирование информации;<br>
                    • обеспечение восстановления персональных данных, модифицированных или уничтоженных вследствие несанкционированного доступа к ним;<br>
                    • обучение работников, использующих средства защиты информации, применяемые в информационных системах персональных данных, правилам работы с ними;<br>
                    • оценка эффективности принимаемых мер по обеспечению безопасности персональных данных;<br>
                    • обнаружение фактов несанкционированного доступа к персональным данным и принятие мер;<br>
                    • контроль за принимаемыми мерами по обеспечению безопасности персональных данных и уровня защищенности информационных систем персональных данных.<br>
                    • размещение технических средств обработки персональных данных, в пределах границ охраняемой территории;<br><br>
                    <strong>6. Права субъектов персональных данных</strong><br>
                    6.1. Субъект персональных данных имеет право на получение сведений об обработке его персональных данных Оператором.<br>
                    6.2. Субъект персональных данных вправе требовать от Оператора уточнения этих персональных данных, их блокирования или уничтожения в случае, если они являются неполными, устаревшими, неточными, незаконно полученными или не могут быть признаны необходимыми для заявленной цели обработки, а также принимать предусмотренные законом меры по защите своих прав.<br>
                    6.3. Право субъекта персональных данных на доступ к его персональным данным может быть ограничено в соответствии с федеральными законами, в том числе, если доступ субъекта персональных данных к его персональным данным нарушает права и законные интересы третьих лиц.<br>
                    6.4. Для реализации и защиты своих прав и законных интересов субъект персональных данных имеет право обратиться к Оператору. Оператор рассматривает любые обращения и жалобы со стороны субъектов персональных данных, тщательно расследует факты нарушений и принимает все необходимые меры для их немедленного устранения, наказания виновных лиц и урегулирования спорных и конфликтных ситуаций в досудебном порядке.<br>
                    6.5. Субъект персональных данных вправе обжаловать действия или бездействие Оператора путем обращения в уполномоченный орган по защите персональных данных.<br>
                    6.6. Субъект персональных данных имеет право на защиту своих прав и законных интересов, в том числе на возмещение убытков и/или компенсацию морального вреда в судебном порядке.<br><br>
                    <strong>7. Доступ к Политике</strong><br>
                    7.1.Действующая редакция Политики на бумажном носителе хранится по адресу нахождению исполнительного органа Оператора по адресу: г. Бишкек, улица Ибраимова 103, БЦ «Victory», 7 этаж.<br>
                    7.2.Электронная версия действующей редакции Политики общедоступна на сайте Оператора в сети Интернет: https://sklads.kg/register<br><br>
                    <strong>8. Актуализация и утверждение Политики</strong><br>
                    8.1.Оператор имеет право вносить изменения в настоящую Политику. При внесении изменений в заголовке Политики указывается дата утверждения действующей редакции Политики.<br>
                    8.2.Политика актуализируется и заново утверждается на регулярной основе – один раз в две года с момента утверждения предыдущей редакции Политики.<br>
                    8.3.Политика может актуализироваться и заново утверждаться ранее срока, указанного в п. 8.2 Политики, по мере внесения изменений:<br>
                    8.4.1.В нормативные правовые акты в сфере персональных данных;<br>
                    8.4.2.В локальные нормативные и индивидуальные акты Оператора, регламентирующие организацию обработки и обеспечение безопасности персональных данных.<br>

                     <br>

                    Приложение А<br>
                    к Политике обработки персональных данных<br>
                    Системы Sklads.kg<br>


                    <strong>Форма согласия</strong><br>
                    <strong>на обработку персональных данных</strong><br>

                    Я, далее - «Субъект персональных данных», в соответствии с Законом Кыргызской Республики «Об информации персонального характера» от 14 апреля 2008 года № 58 г. Бишкек, даю свое согласие ОЮЛ «Союз банков Кыргызстана» (далее – Оператор)              (ИНН: 01901199610051, адрес: Кыргызская Республика, 720011, г.Бишкек, ул.Ибраимова 103, БЦ “Victory”) на обработку моих персональных данных, указанных при регистрации путем заполнения веб-формы на сайте <a href="https://sklads.kg/">https://sklads.kg/</a>  Сервиса (далее – Система), направляемой (заполненной) с использованием Сайта.<br>
                    1. Данное Согласие дается на обработку персональных данных с использованием средств автоматизации. Согласие дается на обработку следующих моих персональных данных: фамилия, имя, отчество; адрес электронной почты; контактный телефон; ИНН/ПИН, Наименование организации); данные обо мне, которые станут известны в ходе исполнения договоров (в случае заключения договора между мной и другими пользователя Системы), а также иная информация, ставшая известной в ходе взаимодействия с Сервисом.<br>
                    2. Датой выдачи согласия на обработку персональных данных является дата отправки регистрационной веб-формы Системы.<br>
                    3. Цель обработки персональных данных: формирование и отправка заявок для внесения в Реестр товарных складов и а так же подтверждения со стороны Уполномоченного органа для внесения данных по Складским свидетельствам в Реестр складских свидетельств; аутенификация Пользователей в Системе; обеспечение работы Сервиса; аналитика действий Пользователей на Сайте.<br>
                    4. Основанием для обработки персональных данных является статья 9 Закона Кыргызской Республики «Об информации персонального характера» и настоящее Согласие на обработку персональных данных.<br>
                    5. В ходе обработки с персональными данными будут совершены следующие действия: сбор, запись, систематизация, накопление, хранение, уточнение (обновление, изменение), использование, передача в установленных законом случаях, блокирование, удаление, уничтожение.<br>
                    6. Обработка персональных данных осуществляется в соответствии с действующим законодательством КР. Оператор принимает необходимые правовые, организационные и технические меры или обеспечивает их принятие для защиты персональных данных от неправомерного или случайного доступа к ним, уничтожения, изменения, блокирования, копирования, предоставления, распространения персональных данных, а также от иных неправомерных действий в отношении персональных данных, а также принимает на себя обязательство сохранения конфиденциальности персональных данных Субъекта персональных данных.<br>
                    7. Настоящим я уведомлен Оператором, что предполагаемыми пользователями персональных данных являются работники Уполномоченных органов, а так же Финансово-кредитных организаций (Банки/Микрофинансовые организации), а также лица, привлеченные Оператором на условиях гражданско-правового договора. Оператор вправе привлекать для обработки персональных данных Субъекта персональных данных субподрядчиков, а также вправе передавать персональные данные для обработки своим аффилированным лицам, обеспечивая при этом принятие такими субподрядчиками и аффилированными лицами соответствующих обязательств в части конфиденциальности персональных данных.<br>
                    8. Я ознакомлен(а), что:
                    8.1. настоящее Согласие на обработку моих персональных данных, указанных при регистрации на сайте Системы, направляемых (заполненных) с использованием Сайта, действует в течение необходимого количества времени, с момента регистрации на Сайте Системы.<br>
                    8.2. настоящее Согласие может быть отозвано посредством направления мною в адрес Оператора (Кыргызская Республика, 720011, г.Бишкек, ул.Ибраимова 103, БЦ “Victory”) письменного заявления. Датой отзыва считается день, следующий за днем вручения Оператору письменного заявления об отзыве Согласия пользователя сайта на обработку персональных данных.<br>
                    8.3. имею право на доступ к моим персональным данным, требовать уточнения (обновление, изменение) моих персональных данных, а также удаления и уничтожения моих персональных данных в случае их обработки Оператором, нарушающих мои законные права и интересы, законодательство Кыргызской Республики.<br>
                    8.4. в случае отзыва Согласия на обработку персональных данных Оператор вправе продолжить обработку персональных данных без моего согласия при наличии оснований, указанных в пунктах статьи 5., Закона КР «Об информации персонального характера» «О персональных данных» от 14 апреля 2008 года № 58г.<br>
                    8.5. предоставление персональных данных третьих лиц без их согласия влечет ответственность в соответствии с действующим законодательством Кыргызской Республики.<br>
                    9. Я обязуюсь в случае изменения моих персональных данных, сведений обо мне незамедлительно сообщить Оператору, с предоставлением подтверждающих документов. 	10. Настоящим Согласием я подтверждаю, что являюсь субъектом предоставляемых персональных данных, а также подтверждаю достоверность предоставляемых данных.<br>
                    11. Настоящее Согласие действует все время до момента прекращения обработки персональных данных, согласно п. 8.1 Согласия, либо до его отзыва субъектом персональных данных.<br><br>


                    <strong>Политика информационной безопасности Системы «Sklads.kg».</strong><br>

                    1.1. Используя Систему посредством Сайта, Пользователь обязуется не нарушать и не пытаться нарушить информационную безопасность Сайта, что, в том числе, включает запрет на совершение действий, указанных в п.5 Пользовательского соглашения (Публичной оферты) Системы «Sklads.kg».<br>
                    1.2. Пользователю запрещается совершение следующих действий при использовании Сайта Системы:<br>
                    1.2.1. получение доступа к данным на Сайте, не предназначенным для данного Пользователя;<br>
                    1.2.2. попытки проверить уязвимость системы безопасности Системы, создать помехи в использовании Системы, что включает в себя, в частности, распространение компьютерных вирусов, постоянную рассылку повторяющейся информации, пересылку уведомлений через сервер Системы, одновременную отправку большого количества электронной почты с целью нарушить работоспособность Системы, а также совершать аналогичные действия, выходящие за рамки нормального целевого использования Системы, и способные повлечь сбои в его работе;<br>
                    1.2.3. попытка посредством Системы рассылки спама, писем, содержащих информацию рекламного характера, иных материалов, не связанных непосредственно с целями работы Системы;
                    1.2.4. имитация и/или подделка любого заголовка пакета TCP/IP или любой части заголовка в любом электронном письме или размещенном на Сайте Системы материале;
                    1.2.5. использование программных средств, имитирующих работу Пользователя/Оператора на Сайте Системы;<br>
                    1.2.6. использование анонимных прокси-серверов;<br>
                    1.2.8. работа с Сайтом посредством IP-адресов, не принадлежащих Оператору/Пользователю;<br>
                    1.2.9. использование функций парсинга/программ парсинга;<br>
                    1.2.10. работа с Сайтом посредством браузера TOR.<br>
                    1.3. Нарушение информационной безопасности сайта влечет за собой гражданскую и уголовную ответственность. Оператор будет расследовать все случаи возможного нарушения безопасности сайта в сотрудничестве с соответствующими органами с целью пресечения подобной деятельности.<br>
                    1.4. Нарушение информационной безопасности Сайта Системы устанавливается Оператором на основе технических и программных средств контроля использования Сайта Системы, а также статистического, логирующего и иного программного обеспечения и оборудования Сайта Системы, а также иной информации и данных, в том числе получаемой Оператором от других лиц.<br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                </div>
            </div>
        </div>
    </div>








    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        let is_captched = false;

        function captching() {
            is_captched = true;
        }

        function validateForm() {
            $('#captcha-web-error').remove();
            if (!is_captched) {
                $('#captcha-container').after(`
                    <div id="captcha-web-error" class="w-100 text-center">
                        <span class="text-danger">
                            <?php echo e(__('captcha required')); ?>

                        </span>
                    </div>
                `)
                return false;
            }
        }

        $(document).ready(function() {
            $('select#user_type').change(function() {
                if (this.value == 1) {
                    $('.emailInput, .orgInput').hide();
                } else {
                    $('.emailInput, .orgInput').show();
                }
            });
        });

    </script>
    <?php echo NoCaptcha::renderJs(); ?>



<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\ga\resources\views/auth/register.blade.php ENDPATH**/ ?>