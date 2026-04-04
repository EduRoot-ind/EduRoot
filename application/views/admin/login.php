<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#1C3A5E">
    <title>Login : <?php echo $name; ?></title>
    <link href="<?php echo base_url(); ?>uploads/school_content/admin_small_logo/<?php echo $this->setting_model->getAdminsmalllogo(); ?>" rel="shortcut icon" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/font-awesome/css/font-awesome.min.css">

    <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; }
    body {
        font-family: 'Sora', sans-serif;
        font-size: 14px;
        -webkit-font-smoothing: antialiased;
        min-height: 100vh;
    }

    /* ── Fullscreen background ── */
    .login-bg {
        position: fixed;
        inset: 0;
        background-color: #1C3A5E;
        background-image: url('https://images.unsplash.com/photo-1497864149936-d3163f0c0f4b?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index: 0;
    }
    .login-bg-overlay {
        position: fixed;
        inset: 0;
        background: rgba(10, 22, 40, 0.62);
        z-index: 1;
    }

    /* ── Page centering ── */
    .login-page {
        position: relative;
        z-index: 2;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 24px 16px;
    }

    /* ════════════════════════════
       MODAL
    ════════════════════════════ */
    .login-modal {
        width: 100%;
        max-width: 400px;
        background: #ffffff;
        border-radius: 6px;
        border: 1px solid rgba(255,255,255,0.12);
        overflow: hidden;
    }

    /* Amber top bar */
    .modal-topbar {
        height: 3px;
        background: #F59E0B;
    }

    .modal-body {
        padding: 32px 36px 36px;
    }

    /* ════════════════════════════
       EDUROOT LOGO BLOCK
       Icon (Navy square + E) + Text
    ════════════════════════════ */
    .er-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 6px;
    }

    /* The square icon — Navy bg, Amber "E" */
    .er-logo-icon {
        width: 44px;
        height: 44px;
        background: #1C3A5E;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .er-logo-icon svg {
        width: 24px;
        height: 24px;
    }

    /* "EduRoot" wordmark */
    .er-logo-text {
        display: flex;
        flex-direction: column;
        line-height: 1;
    }
    .er-logo-wordmark {
        font-size: 1.35rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        color: #1C3A5E;
        line-height: 1;
    }
    .er-logo-wordmark span {
        color: #F59E0B;
    }
    .er-logo-tagline {
        font-size: 0.62rem;
        font-weight: 500;
        color: #B8944A;
        letter-spacing: 0.3px;
        margin-top: 4px;
    }

    /* Divider below logo */
    .er-logo-divider {
        height: 1px;
        background: #E8D5B0;
        margin: 20px 0 22px;
    }

    /* ════════════════════════════
       FORM HEADING
    ════════════════════════════ */
    .modal-heading {
        margin-bottom: 20px;
    }
    .modal-heading-tag {
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.3px;
        color: #B8944A;
        margin-bottom: 4px;
    }
    .modal-heading h2 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1C3A5E;
        letter-spacing: -0.2px;
    }
    .modal-heading p {
        font-size: 0.76rem;
        color: #92723A;
        margin-top: 2px;
    }

    /* ════════════════════════════
       ALERTS
    ════════════════════════════ */
    .alert-box {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        padding: 10px 12px;
        border-radius: 4px;
        font-size: 0.78rem;
        line-height: 1.55;
        margin-bottom: 16px;
        border: 1px solid;
    }
    .alert-box i { margin-top: 1px; flex-shrink: 0; }
    .alert-danger  { background: #FEF2F2; border-color: #FECACA; color: #991B1B; }
    .alert-success { background: #ECFDF5; border-color: #A7F3D0; color: #065F46; }

    /* ════════════════════════════
       FORM
    ════════════════════════════ */
    .form-group { margin-bottom: 14px; }

    .form-label {
        display: block;
        font-size: 0.66rem;
        font-weight: 600;
        color: #6B4C2A;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 6px;
    }

    .input-wrap { position: relative; }

    .input-icon {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #B8944A;
        font-size: 0.78rem;
        pointer-events: none;
    }

    .form-input {
        width: 100%;
        padding: 10px 12px 10px 33px;
        border: 1px solid #D4B483;
        border-radius: 4px;
        background: #FEFCF8;
        color: #0A1628;
        font-family: 'Sora', sans-serif;
        font-size: 0.85rem;
        outline: none;
        transition: border-color 0.15s;
    }
    .form-input::placeholder { color: #C4A882; }
    .form-input:focus {
        border-color: #1C3A5E;
        background: #ffffff;
    }

    .field-error {
        display: block;
        font-size: 0.68rem;
        color: #DC2626;
        margin-top: 4px;
    }

    /* Captcha */
    .captcha-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 14px;
    }
    .captcha-box {
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #D4B483;
        border-radius: 4px;
        padding: 7px 10px;
        background: #FEFCF8;
    }
    .captcha-box .fa-refresh {
        cursor: pointer;
        color: #B8944A;
        font-size: 0.78rem;
    }
    .captcha-box .fa-refresh:hover { color: #1C3A5E; }

    /* Submit */
    .btn-login {
        width: 100%;
        padding: 11px 16px;
        margin-top: 4px;
        background: #1C3A5E;
        color: #ffffff;
        border: none;
        border-radius: 4px;
        font-family: 'Sora', sans-serif;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.15s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
    }
    .btn-login:hover { background: #1E4080; }

    /* Modal footer links */
    .modal-links {
        margin-top: 16px;
        padding-top: 14px;
        border-top: 1px solid #E8D5B0;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .modal-links a {
        font-size: 0.74rem;
        color: #92723A;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .modal-links a:hover { color: #1C3A5E; }
    .link-sep { width: 1px; height: 12px; background: #D4B483; }

    /* ════════════════════════════
       SCHOOL NAME TAG — below modal
    ════════════════════════════ */
    .school-tag {
        margin-top: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.72rem;
        color: rgba(249,244,236,0.55);
    }
    .school-tag-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #059669;
        flex-shrink: 0;
    }

    /* ════════════════════════════
       NOTICES — below modal
    ════════════════════════════ */
    .notice-panel {
        width: 100%;
        max-width: 400px;
        margin-top: 10px;
        background: rgba(10, 22, 40, 0.75);
        border: 1px solid rgba(245,158,11,0.15);
        border-left: 3px solid #F59E0B;
        border-radius: 4px;
        padding: 14px 18px;
    }
    .notice-panel-tag {
        font-size: 0.58rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: #FBBF24;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .notice-panel-tag::before {
        content: '';
        display: block;
        width: 12px;
        height: 2px;
        background: #F59E0B;
    }
    .notice-items {
        display: flex;
        flex-direction: column;
        gap: 0;
        max-height: 160px;
        overflow-y: auto;
    }
    .notice-items::-webkit-scrollbar { width: 3px; }
    .notice-items::-webkit-scrollbar-thumb {
        background: rgba(245,158,11,0.35);
        border-radius: 2px;
    }
    .notice-item {
        padding: 8px 0;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }
    .notice-item:last-child { border-bottom: none; padding-bottom: 0; }
    .notice-item h4 {
        font-size: 0.75rem;
        font-weight: 600;
        color: #F9F4EC;
        margin-bottom: 2px;
    }
    .notice-item p {
        font-size: 0.7rem;
        color: rgba(249,244,236,0.48);
        line-height: 1.55;
    }
    .notice-item p a.more {
        color: #FBBF24;
        text-decoration: none;
        font-weight: 600;
    }

    /* Mobile */
    @media (max-width: 480px) {
        .modal-body { padding: 24px 20px 28px; }
    }
    </style>
</head>
<body>

<div class="login-bg"></div>
<div class="login-bg-overlay"></div>

<div class="login-page">

    <!-- ══ MODAL ══ -->
    <div class="login-modal">

        <div class="modal-topbar"></div>

        <div class="modal-body">

            <!-- EduRoot Logo -->
            <div class="er-logo">

                <!-- Wordmark -->
                <div class="er-logo-text">
                    <div class="er-logo-wordmark">
                        Edu<span>Root</span>
                    </div>
                    <div class="er-logo-tagline">School ERP System</div>
                </div>

            </div>

            <div class="er-logo-divider"></div>

            <!-- Form heading -->
            <div class="modal-heading">
                <div class="modal-heading-tag">Admin Portal</div>
                <h2><?php echo $this->lang->line('admin_login'); ?></h2>
            </div>

            <!-- Alerts -->
            <?php if (isset($error_message)) : ?>
            <div class="alert-box alert-danger">
                <i class="fa fa-exclamation-circle"></i>
                <span><?php echo $error_message; ?></span>
            </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('message')) : ?>
            <div class="alert-box alert-success">
                <i class="fa fa-check-circle"></i>
                <span><?php echo $this->session->flashdata('message'); ?></span>
            </div>
            <?php $this->session->unset_userdata('message'); ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('disable_message')) : ?>
            <div class="alert-box alert-danger">
                <i class="fa fa-ban"></i>
                <span><?php echo $this->session->flashdata('disable_message'); ?></span>
            </div>
            <?php $this->session->unset_userdata('disable_message'); ?>
            <?php endif; ?>

            <!-- Form -->
            <form action="<?php echo site_url('site/login') ?>" method="post">
                <?php echo $this->customlib->getCSRF(); ?>

                <div class="form-group">
                    <label class="form-label" for="form-username">
                        <?php echo $this->lang->line('username'); ?>
                    </label>
                    <div class="input-wrap">
                        <i class="fa fa-user input-icon"></i>
                        <input
                            type="text"
                            name="username"
                            id="form-username"
                            placeholder="Enter username"
                            value="<?php echo set_value('username') ?>"
                            class="form-input"
                            autocomplete="username"
                        >
                    </div>
                    <span class="field-error"><?php echo form_error('username'); ?></span>
                </div>

                <div class="form-group">
                    <label class="form-label" for="form-password">
                        <?php echo $this->lang->line('password'); ?>
                    </label>
                    <div class="input-wrap">
                        <i class="fa fa-lock input-icon"></i>
                        <input
                            type="password"
                            name="password"
                            id="form-password"
                            value="<?php echo set_value('password') ?>"
                            placeholder="Enter password"
                            class="form-input"
                            autocomplete="current-password"
                        >
                    </div>
                    <span class="field-error"><?php echo form_error('password'); ?></span>
                </div>

                <?php if ($is_captcha) : ?>
                <div class="captcha-row">
                    <div class="captcha-box">
                        <span id="captcha_image"><?php echo $captcha_image; ?></span>
                        <i class="fa fa-refresh" title="Refresh Captcha" onclick="refreshCaptcha()"></i>
                    </div>
                    <div>
                        <input
                            type="text"
                            name="captcha"
                            placeholder="<?php echo $this->lang->line('captcha'); ?>"
                            class="form-input"
                            style="padding-left:12px;"
                            autocomplete="off"
                            id="captcha"
                        >
                        <span class="field-error"><?php echo form_error('captcha'); ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <button type="submit" class="btn-login">
                    <i class="fa fa-sign-in"></i>
                    <?php echo $this->lang->line('sign_in'); ?>
                </button>
            </form>

            <!-- Links -->
            <div class="modal-links">
                <a href="<?php echo site_url('site/forgotpassword') ?>">
                    <i class="fa fa-key"></i>
                    <?php echo $this->lang->line('forgot_password'); ?>?
                </a>
                <div class="link-sep"></div>
                <a href="<?php echo site_url('site/userlogin') ?>">
                    <i class="fa fa-user"></i>
                    User Login
                </a>
            </div>

        </div><!-- /.modal-body -->
    </div><!-- /.login-modal -->

    <!-- School name + status — below modal -->
    <div class="school-tag">
        <div class="school-tag-dot"></div>
        <?php echo $name; ?> &nbsp;·&nbsp; Secure Session
    </div>

    <!-- Notices — below modal if exist -->
    <?php if ($notice) : ?>
    <div class="notice-panel">
        <div class="notice-panel-tag">
            <?php echo $this->lang->line('whats_new_in'); ?> <?php echo $school['name']; ?>
        </div>
        <div class="notice-items">
            <?php foreach ($notice as $notice_value) : ?>
            <?php
                $string = strip_tags($notice_value['description']);
                if (mb_strlen($string, 'UTF-8') > 120) {
                    $stringCut = mb_substr($string, 0, 120, 'UTF-8');
                    $endPoint  = mb_strrpos($stringCut, ' ', 0, 'UTF-8');
                    $string    = ($endPoint !== false)
                        ? mb_substr($stringCut, 0, $endPoint, 'UTF-8')
                        : $stringCut;
                    $string .= '... <a class="more" href="'
                        . site_url('read/' . $notice_value['slug'])
                        . '" target="_blank">'
                        . $this->lang->line('read_more') . '</a>';
                }
            ?>
            <div class="notice-item">
                <h4><?php echo $notice_value['title']; ?></h4>
                <p><?php echo $string; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

</div><!-- /.login-page -->

<script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
<script>
function refreshCaptcha() {
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('site/refreshCaptcha'); ?>',
        success: function (captcha) {
            $('#captcha_image').html(captcha);
        }
    });
}
</script>
</body>
</html>