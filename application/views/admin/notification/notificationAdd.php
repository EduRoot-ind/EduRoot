<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <form id="form1" action="<?php echo base_url() ?>admin/notification/add" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-commenting-o"></i> <?php echo $this->lang->line('compose_new_message'); ?></h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg');
                                    $this->session->unset_userdata('msg'); ?>
                                <?php } ?>
                                <?php echo $this->customlib->getCSRF(); ?>

                                <!-- LEFT: Message Fields -->
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <div class="row">
                                        <?php if ($sms_validation == 1) { $class = "show"; } else { $class = "hide"; } ?>

                                        <div class="col-md-12 <?php echo $class; ?>" id="sms_template_id">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('sms_template'); ?> (<?php echo $this->lang->line('this_field_is_reqiured_only_for_indian_sms_gateway'); ?>)</label>
                                                <input type="text" name="template_id" id="template_id" class="form-control" autocomplete="off">
                                                <span class="text-danger"><?php echo form_error('template_id'); ?></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('title'); ?></label><small class="req"> *</small>
                                                <input autofocus="" id="title" name="title" type="text" class="form-control" value="<?php echo set_value('title'); ?>" />
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('notice_date'); ?></label><small class="req"> *</small>
                                                <input id="date" name="date" type="text" class="form-control date" value="<?php echo set_value('date'); ?>" />
                                                <span class="text-danger"><?php echo form_error('date'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('publish_on'); ?></label><small class="req"> *</small>
                                                <input id="publish_date" name="publish_date" type="text" class="form-control date" value="<?php echo set_value('publish_date'); ?>" />
                                                <span class="text-danger"><?php echo form_error('publish_date'); ?></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('attachment'); ?></label>
                                                <input type="file" id="file" name="file" class="form-control filestyle" autocomplete="off" />
                                                <span class="text-danger"><?php echo form_error('file'); ?></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('message'); ?></label><small class="req"> *</small>
                                                <textarea id="compose-textarea" name="message" class="form-control" style="height:300px"><?php echo set_value('message'); ?></textarea>
                                                <span class="text-danger"><?php echo form_error('message'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- RIGHT: Recipients + Send By -->
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="">
                                        <?php if (isset($error_message)) { ?>
                                            <div class='alert alert-danger'><?php echo $error_message; ?></div>
                                        <?php } ?>

                                        <div class="form-horizontal">
                                            <label><?php echo $this->lang->line('message_to'); ?></label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="student_checkbox" name="visible[]" value="student" <?php echo set_checkbox('visible[]', 'student', false) ?> />
                                                    <b><?php echo $this->lang->line('student'); ?></b>
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="visible[]" value="parent" <?php echo set_checkbox('visible[]', 'parent', false) ?> />
                                                    <b><?php echo $this->lang->line('parent'); ?></b>
                                                </label>
                                            </div>
                                            <?php foreach ($roles as $role_key => $role_value) {
                                                $userdata = $this->customlib->getUserData();
                                                $role_id  = $userdata["role_id"]; ?>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="visible[]"
                                                               value="<?php echo $role_value['id']; ?>"
                                                               <?php if ($role_value["id"] == $role_id) echo "checked"; ?>
                                                               <?php echo set_checkbox('visible[]', $role_value['id'], false) ?> />
                                                        <b><?php echo $role_value['name']; ?></b>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('visible[]'); ?></span>
                                    </div>

                                    <br>
                                    <div class="pt5">
                                        <div class="form-horizontal">
                                            <label><?php echo $this->lang->line('send_by'); ?></label>
                                            <div class="">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="mail" id="mail" value="1" <?php if (isset($mail)) echo "checked"; ?>>
                                                    <?php echo $this->lang->line('email'); ?>
                                                </label>
                                            </div>
                                            <div class="">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="sms" id="sms" value="1" <?php if (isset($sms)) echo "checked"; ?>>
                                                    <?php echo $this->lang->line('sms'); ?>
                                                </label>
                                            </div>
                                            <div class="" id="mobile_notification_div">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="mobile_notification" id="mobile_notification" value="1" <?php if (isset($mobile_notification)) echo "checked"; ?>>
                                                    <?php echo $this->lang->line('mobile_app') ?>
                                                </label>
                                            </div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('mail'); ?></span>
                                        <span class="text-danger"><?php echo form_error('sms'); ?></span>
                                        <span class="text-danger"><?php echo form_error('mobile_notification'); ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="button" class="btn btn-success" style="margin-right:8px;" onclick="openWANoticeModal()">
                                    <i class="fa fa-whatsapp"></i> Send via WhatsApp
                                </button>
                                <button type="submit" id="submitbtn" class="btn btn-primary">
                                    <i class="fa fa-envelope-o"></i> <?php echo $this->lang->line('send'); ?>
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
</div>


<!-- ================================================================
     WHATSAPP NOTICE MODAL
================================================================ -->
<div class="modal fade" id="waNoticeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header" style="background:#25D366;color:#fff;border-radius:4px 4px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:1;"><span>×</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-whatsapp"></i> Send Notice via WhatsApp
                </h4>
            </div>

            <div class="modal-body">

                <!-- Message Preview -->
                <div class="panel panel-default" style="margin-bottom:14px;">
                    <div class="panel-heading" style="padding:8px 12px;background:#f9f9f9;">
                        <strong><i class="fa fa-envelope-o"></i> Message:</strong>
                    </div>
                    <div class="panel-body" style="background:#ECE5DD;padding:10px;">
                        <div style="background:#fff;border-radius:8px;padding:12px;box-shadow:0 1px 2px rgba(0,0,0,.2);">
                            <pre id="waNoticePreview"
                                 style="font-size:13px;white-space:pre-wrap;margin:0;
                                        font-family:inherit;background:transparent;
                                        border:none;padding:0;max-height:120px;overflow-y:auto;"></pre>
                        </div>
                    </div>
                </div>

                <!-- Loading -->
                <div id="waRecipientsLoader" class="text-center" style="padding:24px;">
                    <i class="fa fa-spinner fa-spin fa-2x text-success"></i>
                    <p class="text-muted" style="margin-top:8px;">Loading recipient lists...</p>
                </div>

                <!-- Tabs container — filled dynamically -->
                <div id="waRecipientTabs" style="display:none;">

                    <!-- Tab Headers -->
                    <ul class="nav nav-tabs" id="waTabHeaders" style="margin-bottom:0;"></ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="waTabContent"
                         style="border:1px solid #ddd;border-top:none;border-radius:0 0 4px 4px;"></div>

                    <!-- Total count -->
                    <div style="padding:8px 12px;background:#f9f9f9;border:1px solid #ddd;border-top:none;
                                border-radius:0 0 4px 4px;font-size:13px;">
                        <span id="waTotalCount" class="text-muted"></span>
                        <span class="pull-right text-warning" style="font-size:12px;">
                            <i class="fa fa-info-circle"></i>
                            Only recipients with a mobile number will receive messages.
                        </span>
                    </div>

                </div>

                <!-- Alerts -->
                <div id="waNoticeSuccess" class="alert alert-success" style="display:none;margin-top:10px;"></div>
                <div id="waNoticeError"   class="alert alert-danger"  style="display:none;margin-top:10px;"></div>

            </div>

            <div class="modal-footer">
                <span class="text-muted" id="waNoticeSendingStatus" style="float:left;padding-top:8px;font-size:13px;"></span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="waNoticeSendBtn" class="btn btn-success btn-lg" onclick="waSendNotice()">
                    <i class="fa fa-whatsapp"></i> Confirm &amp; Send
                </button>
            </div>

        </div>
    </div>
</div>


<!-- ================================================================
     EXISTING SCRIPTS (unchanged)
================================================================ -->
<script type="text/javascript">
    $(document).ready(function () {
        $("#btnreset").click(function () { $("#form1")[0].reset(); });
    });
</script>
<script>
    $(function () { $("#compose-textarea").wysihtml5(); });
</script>
<script>
    $(function () {
        $('#form1').submit(function () { $("#submitbtn").button('loading'); });
    });
</script>
<script>
    $("#sms").change(function () {
        if ($('#sms').is(":checked")) {
            $("#sms_template_id").addClass("show").removeClass("hide");
        } else {
            $('#template_id').val("");
            $("#sms_template_id").removeClass("show").addClass("hide");
        }
    });

    $("#mobile_notification_div").addClass("hide");
    $("#student_checkbox").change(function () {
        if ($('#student_checkbox').is(":checked")) {
            $("#mobile_notification_div").addClass("show").removeClass("hide");
        } else {
            $('#mobile_notification').prop('checked', false);
            $("#mobile_notification_div").removeClass("show").addClass("hide");
        }
    });
</script>


<!-- ================================================================
     WHATSAPP MODAL JAVASCRIPT
================================================================ -->
<script>
var waCsrfNameNotice = '<?php echo $this->security->get_csrf_token_name(); ?>';
var waCsrfHashNotice = '<?php echo $this->security->get_csrf_hash(); ?>';
var waSiteUrlNotice  = '<?php echo site_url(); ?>';

// ---- Get plain text from wysihtml5 ----
function waGetPlainMessage() {
    var raw = '';
    try {
        var editor = $('#compose-textarea').data('wysihtml5');
        raw = (editor && editor.editor) ? editor.editor.getValue() : $('#compose-textarea').val();
    } catch(e) {
        raw = $('#compose-textarea').val();
    }
    return raw.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
}

// ---- Open modal ----
function openWANoticeModal() {

    // Validate recipients
    var visible = [];
    $('input[name="visible[]"]:checked').each(function() { visible.push($(this).val()); });
    if (visible.length === 0) {
        alert('Please select at least one recipient in "Message To" before sending via WhatsApp.');
        return;
    }

    // Validate message
    var plainMessage = waGetPlainMessage();
    if (!plainMessage) {
        alert('Please type a message before sending via WhatsApp.');
        return;
    }

    // Show message preview
    $('#waNoticePreview').text(plainMessage);

    // Reset UI
    $('#waNoticeSuccess, #waNoticeError').hide();
    $('#waNoticeSendingStatus').text('');
    $('#waNoticeSendBtn').prop('disabled', false).html('<i class="fa fa-whatsapp"></i> Confirm &amp; Send');
    $('#waRecipientTabs').hide();
    $('#waRecipientsLoader').show();
    $('#waTabHeaders').html('');
    $('#waTabContent').html('');
    $('#waTotalCount').text('');

    $('#waNoticeModal').modal('show');

    // Load recipient lists via AJAX
    var postData = {};
    postData[waCsrfNameNotice] = waCsrfHashNotice;
    postData['visible']        = visible;

    $.ajax({
        url:      waSiteUrlNotice + 'admin/notification/get_whatsapp_recipients',
        type:     'POST',
        data:     postData,
        dataType: 'json',
        success: function(res) {
            $('#waRecipientsLoader').hide();
            if (res.status == 1) {
                if (res.csrf) waCsrfHashNotice = res.csrf;
                waRenderTabs(res.data);
                $('#waRecipientTabs').show();
            } else {
                $('#waNoticeError').text('Could not load recipients.').show();
            }
        },
        error: function() {
            $('#waRecipientsLoader').hide();
            $('#waNoticeError').text('Server error loading recipients.').show();
        }
    });
}

// ---- Render tabs ----
function waRenderTabs(data) {
    var keys       = Object.keys(data);
    var headers    = '';
    var contents   = '';
    var totalAll   = 0;
    var totalMobile = 0;

    keys.forEach(function(key, i) {
        var group    = data[key];
        var label    = group.label;
        var list     = group.list;
        var withMobile    = list.filter(function(p) { return p.mobile; }).length;
        var withoutMobile = list.length - withMobile;
        var active   = (i === 0) ? 'active' : '';
        var tabId    = 'waTab_' + key;

        totalAll    += list.length;
        totalMobile += withMobile;

        // Tab header
        headers += '<li class="' + active + '">'
                 + '<a href="#' + tabId + '" data-toggle="tab">'
                 + label
                 + ' <span class="badge" style="background:#25D366;">' + list.length + '</span>'
                 + '</a></li>';

        // Tab content — build table
        var rows = '';
        list.forEach(function(p, idx) {
            var mobileBadge = p.mobile
                ? '<span class="text-success"><i class="fa fa-check"></i> ' + p.mobile + '</span>'
                : '<span class="text-danger"><i class="fa fa-times"></i> No mobile</span>';
            rows += '<tr>'
                  + '<td>' + (idx + 1) + '</td>'
                  + '<td>' + (p.name || '—') + '</td>'
                  + '<td>' + mobileBadge + '</td>'
                  + '<td><small class="text-muted">' + (p.extra || '') + '</small></td>'
                  + '</tr>';
        });

        var summary = '<div style="padding:8px 12px;background:#f9f9f9;font-size:12px;border-bottom:1px solid #ddd;">'
                    + '<i class="fa fa-users"></i> Total: <strong>' + list.length + '</strong>'
                    + ' &nbsp;|&nbsp; <span class="text-success"><i class="fa fa-whatsapp"></i> Will receive: <strong>' + withMobile + '</strong></span>'
                    + (withoutMobile > 0 ? ' &nbsp;|&nbsp; <span class="text-danger">No mobile: <strong>' + withoutMobile + '</strong></span>' : '')
                    + '</div>';

        contents += '<div class="tab-pane ' + active + '" id="' + tabId + '">'
                  + summary
                  + '<div style="max-height:280px;overflow-y:auto;">'
                  + '<table class="table table-condensed table-hover" style="margin:0;font-size:13px;">'
                  + '<thead style="background:#f4f4f4;">'
                  + '<tr><th width="40">#</th><th>Name</th><th>Mobile</th><th>Info</th></tr>'
                  + '</thead><tbody>' + rows + '</tbody>'
                  + '</table>'
                  + '</div>'
                  + '</div>';
    });

    $('#waTabHeaders').html(headers);
    $('#waTabContent').html(contents);
    $('#waTotalCount').html(
        '<i class="fa fa-users"></i> Total recipients: <strong>' + totalAll + '</strong>'
        + ' &nbsp;|&nbsp; '
        + '<span class="text-success"><i class="fa fa-whatsapp"></i> Will receive WhatsApp: <strong>' + totalMobile + '</strong></span>'
    );
}

// ---- Confirm and send ----
function waSendNotice() {
    var visible = [];
    $('input[name="visible[]"]:checked').each(function() { visible.push($(this).val()); });

    var plainMessage = waGetPlainMessage();
    var title        = $('#title').val();

    if (!plainMessage) {
        $('#waNoticeError').text('Message cannot be empty.').show();
        return;
    }

    $('#waNoticeSendBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Sending...');
    $('#waNoticeSuccess, #waNoticeError').hide();
    $('#waNoticeSendingStatus').text('Sending messages to all recipients with mobile numbers...');

    var postData = {};
    postData[waCsrfNameNotice] = waCsrfHashNotice;
    postData['title']          = title;
    postData['message']        = plainMessage;
    postData['visible']        = visible;

    $.ajax({
        url:      waSiteUrlNotice + 'admin/notification/send_whatsapp_notice',
        type:     'POST',
        data:     postData,
        dataType: 'json',
        success: function(res) {
            $('#waNoticeSendingStatus').text('');
            if (res.status == 1) {
                $('#waNoticeSuccess')
                    .html('<i class="fa fa-check-circle"></i> <strong>Done!</strong> '
                        + 'Sent: <strong>' + res.sent + '</strong> &nbsp;|&nbsp; '
                        + 'Failed/No mobile: <strong>' + res.failed + '</strong>')
                    .show();
                $('#waNoticeSendBtn').prop('disabled', false).html('<i class="fa fa-check"></i> Sent!');
                if (res.csrf) waCsrfHashNotice = res.csrf;
            } else {
                $('#waNoticeError').text(res.message || 'Error sending.').show();
                $('#waNoticeSendBtn').prop('disabled', false).html('<i class="fa fa-whatsapp"></i> Confirm &amp; Send');
            }
        },
        error: function(xhr) {
            $('#waNoticeSendingStatus').text('');
            $('#waNoticeError').text('Server error (' + xhr.status + '). Please try again.').show();
            $('#waNoticeSendBtn').prop('disabled', false).html('<i class="fa fa-whatsapp"></i> Confirm &amp; Send');
        }
    });
}
</script>