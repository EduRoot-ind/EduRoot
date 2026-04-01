<style type="text/css">
    .radio { padding-left: 20px; }
    .radio label { display: inline-block; vertical-align: middle; position: relative; padding-left: 5px; }
    .radio label::before { content: ""; display: inline-block; position: absolute; width: 17px; height: 17px; left: 0; margin-left: -20px; border: 1px solid #cccccc; border-radius: 50%; background-color: #fff; -webkit-transition: border 0.15s ease-in-out; -o-transition: border 0.15s ease-in-out; transition: border 0.15s ease-in-out; }
    .radio label::after { display: inline-block; position: absolute; content: " "; width: 11px; height: 11px; left: 3px; top: 3px; margin-left: -20px; border-radius: 50%; background-color: #555555; -webkit-transform: scale(0, 0); -ms-transform: scale(0, 0); -o-transform: scale(0, 0); transform: scale(0, 0); -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33); -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33); -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33); transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33); }
    .radio input[type="radio"] { opacity: 0; z-index: 1; }
    .radio input[type="radio"]:focus+label::before { outline: thin dotted; outline: 5px auto -webkit-focus-ring-color; outline-offset: -2px; }
    .radio input[type="radio"]:checked+label::after { -webkit-transform: scale(1, 1); -ms-transform: scale(1, 1); -o-transform: scale(1, 1); transform: scale(1, 1); }
    .radio input[type="radio"]:disabled+label { opacity: 0.65; }
    .radio input[type="radio"]:disabled+label::before { cursor: not-allowed; }
    .radio.radio-inline { margin-top: 0; }
    .radio-primary input[type="radio"]+label::after { background-color: #337ab7; }
    .radio-primary input[type="radio"]:checked+label::before { border-color: #337ab7; }
    .radio-primary input[type="radio"]:checked+label::after { background-color: #337ab7; }
    .radio-danger input[type="radio"]+label::after { background-color: #d9534f; }
    .radio-danger input[type="radio"]:checked+label::before { border-color: #d9534f; }
    .radio-danger input[type="radio"]:checked+label::after { background-color: #d9534f; }
    .radio-info input[type="radio"]+label::after { background-color: #5bc0de; }
    .radio-info input[type="radio"]:checked+label::before { border-color: #5bc0de; }
    .radio-info input[type="radio"]:checked+label::after { background-color: #5bc0de; }
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1><i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?> </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <form id='form1' action="<?php echo site_url('admin/stuattendence/attendencereport') ?>" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php foreach ($classlist as $class) { ?>
                                                <option value="<?php echo $class['id'] ?>" <?php if ($class_id == $class['id']) echo "selected=selected"; ?>>
                                                    <?php echo $class['class'] ?>
                                                </option>
                                            <?php $count++; } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                        <select id="section_id" name="section_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('attendance_date'); ?></label>
                                        <input name="date" type="text" class="form-control date"
                                               value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat())); ?>"
                                               readonly="readonly" />
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" name="search" value="search"
                                                class="btn btn-primary btn-sm pull-right checkbox-toggle">
                                            <i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php if (isset($resultlist)) { ?>
                        <div class="">
                            <div class="box-header ptbnull"></div>
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                    <i class="fa fa-users"></i> <?php echo $this->lang->line('attendance_list'); ?>
                                </h3>
                                <div class="box-tools pull-right">
                                    <?php if (!empty($resultlist)) { ?>
                                        <button type="button" class="btn btn-info btn-sm"
                                                style="margin-right:5px;"
                                                onclick="openWAAttendTplModal()">
                                            <i class="fa fa-pencil"></i> Edit Template
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm"
                                                onclick="openWAAttendanceModal()">
                                            <i class="fa fa-whatsapp"></i> Send to Parents
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="box-body">
                                <?php if (!empty($resultlist)) { ?>
                                    <div class="mailbox-controls"><div class="pull-right"></div></div>
                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                                    <input type="hidden" name="date" value="<?php echo $date; ?>">
                                    <div class="download_label">
                                        <?php echo $this->lang->line('attendance_list'); ?>
                                        <?php echo $this->customlib->get_postmessage(); ?>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped myexample"
                                               data-export-title="<?php echo $this->lang->line('attendance_list'); ?>">
                                            <thead>
                                                <tr>
                                                    <th class="dt-body-left dt-head-left">#</th>
                                                    <th class="dt-body-left dt-head-left"><?php echo $this->lang->line('admission_no'); ?></th>
                                                    <?php if ($sch_setting->roll_no) { ?>
                                                        <th class="dt-body-left dt-head-left"><?php echo $this->lang->line('roll_number'); ?></th>
                                                    <?php } ?>
                                                    <th><?php echo $this->lang->line('name'); ?></th>
                                                    <th class="noteinput"><?php echo $this->lang->line('attendance'); ?></th>
                                                    <th><?php echo $this->lang->line('note'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $row_count = 1;
                                                foreach ($resultlist as $key => $value) { ?>
                                                    <tr>
                                                        <td class="dt-body-left dt-head-left"><?php echo $row_count; ?></td>
                                                        <td class="dt-body-left dt-head-left"><?php echo $value['admission_no']; ?></td>
                                                        <?php if ($sch_setting->roll_no) { ?>
                                                            <td class="dt-body-left dt-head-left"><?php echo $value['roll_no']; ?></td>
                                                        <?php } ?>
                                                        <td>
                                                            <?php echo $this->customlib->getFullName(
                                                                $value['firstname'], $value['middlename'], $value['lastname'],
                                                                $sch_setting->middlename, $sch_setting->lastname
                                                            ); ?>
                                                        </td>
                                                        <td class="noteinput">
                                                            <?php
                                                            $c = 1;
                                                            foreach ($attendencetypeslist as $key => $type) {
                                                                $att_type = str_replace(" ", "_", strtolower($type['type']));
                                                                if ($value['date'] != "xxx") {
                                                                    if ($value['attendence_type_id'] == $type['id']) {
                                                                        if ($type['id'] == "1") { ?>
                                                                            <small class="label label-success"><?php echo $this->lang->line($att_type) ?></small>
                                                                        <?php } elseif ($type['id'] == "3") { ?>
                                                                            <small class="label label-warning"><?php echo $this->lang->line($att_type) ?></small>
                                                                        <?php } elseif ($type['id'] == "2") { ?>
                                                                            <small class="label label-primary"><?php echo $this->lang->line($att_type) ?></small>
                                                                        <?php } elseif ($type['id'] == "6") { ?>
                                                                            <small class="label label-info"><?php echo $this->lang->line($att_type) ?></small>
                                                                        <?php } elseif ($type['id'] == "5") { ?>
                                                                            <small class="label label-default"><?php echo $this->lang->line($att_type) ?></small>
                                                                        <?php } else { ?>
                                                                            <small class="label label-danger"><?php echo $this->lang->line($att_type) ?></small>
                                                                        <?php }
                                                                    }
                                                                } else { ?>
                                                                    <div class="radio radio-info radio-inline">
                                                                        <input <?php if ($c == 1) echo "checked"; ?> type="radio"
                                                                            id="attendencetype<?php echo $value['student_session_id']; ?>"
                                                                            value="<?php echo $type['id'] ?>"
                                                                            name="attendencetype<?php echo $value['student_session_id']; ?>">
                                                                        <label for="inlineRadio1"> <?php echo $this->lang->line($att_type) ?> </label>
                                                                    </div>
                                                                <?php }
                                                                $c++;
                                                            } ?>
                                                        </td>
                                                        <td><?php echo $value['remark']; ?></td>
                                                    </tr>
                                                <?php $row_count++; } ?>
                                            </tbody>
                                        </table>
                                <?php } else { ?>
                                    <div class="alert alert-info">
                                        <?php echo $this->lang->line('no_attendance_prepared'); ?>
                                    </div>
                                <?php } ?>
                                    </div>
                            </div>
                        </div>
                </div>
            <?php } ?>
    </section>
</div>


<?php if (isset($resultlist) && !empty($resultlist)) { ?>

<!-- ================================================================
     SHARED JS VARIABLES
================================================================ -->
<script>
var waDate     = '<?php echo addslashes($date); ?>';
var waSiteUrl  = '<?php echo site_url(); ?>';
var waCsrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
var waCsrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

var waAllStudents = <?php
    $wa_data = [];
    foreach ($resultlist as $v) {
        $wa_data[] = [
            'student_session_id' => $v['student_session_id'],
            'admission_no'       => $v['admission_no'],
            'roll_no'            => $v['roll_no'] ?? '',
            'name'               => trim($v['firstname'] . ' ' . ($v['middlename'] ?? '') . ' ' . ($v['lastname'] ?? '')),
            'attendence_type_id' => $v['attendence_type_id'] ?? 0,
            'date_marked'        => $v['date'],
            'parent_phone'       => $v['parent_phone'] ?? '',
            'father_name'        => $v['father_name'] ?? '',
        ];
    }
    echo json_encode($wa_data);
?>;
</script>

<!-- ================================================================
     MODAL 1 — SEND TO PARENTS
================================================================ -->
<div class="modal fade" id="waAttendanceModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header" style="background:#25D366;color:#fff;border-radius:4px 4px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:1;"><span>×</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-whatsapp"></i> Send Attendance to Parents
                    <small style="color:rgba(255,255,255,.8);font-size:13px;margin-left:8px;">
                        <?php echo $date; ?>
                    </small>
                </h4>
            </div>

            <div class="modal-body">
                <div class="row" style="margin-bottom:14px;">
                    <div class="col-md-8">
                        <label style="margin-right:10px;font-weight:600;">Send to:</label>
                        <div class="btn-group" id="waFilterGroup">
                            <button type="button" class="btn btn-danger btn-sm active" onclick="waSetFilter('absent')">
                                <i class="fa fa-times-circle"></i> Absent Only
                            </button>
                            <button type="button" class="btn btn-success btn-sm" onclick="waSetFilter('present')">
                                <i class="fa fa-check-circle"></i> Present Only
                            </button>
                            <button type="button" class="btn btn-default btn-sm" onclick="waSetFilter('all')">
                                <i class="fa fa-users"></i> All Students
                            </button>
                        </div>
                        <span class="text-muted" style="margin-left:10px;font-size:13px;" id="waFilterCount"></span>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-info btn-sm"
                                onclick="$('#waAttendanceModal').modal('hide'); openWAAttendTplModal();">
                            <i class="fa fa-pencil"></i> Edit Template
                        </button>
                    </div>
                </div>

                <div class="panel panel-default" style="margin-bottom:12px;">
                    <div class="panel-heading" style="padding:8px 12px;">
                        <strong><i class="fa fa-mobile"></i> Message Preview</strong>
                        <small class="text-muted pull-right">From Notification Settings template</small>
                    </div>
                    <div class="panel-body" style="background:#ECE5DD;padding:12px;">
                        <div style="background:#fff;border-radius:8px;padding:12px;max-width:340px;box-shadow:0 1px 2px rgba(0,0,0,.2);">
                            <pre id="waAttendPreview"
                                 style="font-size:12px;white-space:pre-wrap;margin:0;font-family:inherit;background:transparent;border:none;padding:0;">Loading...</pre>
                        </div>
                    </div>
                </div>

                <div style="max-height:300px;overflow-y:auto;border:1px solid #ddd;border-radius:4px;">
                    <table class="table table-condensed table-hover" style="margin:0;font-size:13px;">
                        <thead style="background:#f4f4f4;">
                            <tr>
                                <th width="38"><input type="checkbox" id="waSelectAll" onchange="waToggleAll(this)" checked></th>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Adm No</th>
                                <th>Status</th>
                                <th>Phone</th>
                                <th>WA Status</th>
                            </tr>
                        </thead>
                        <tbody id="waStudentTableBody"></tbody>
                    </table>
                </div>

                <div id="waSuccessAlert" class="alert alert-success" style="display:none;margin-top:10px;"></div>
                <div id="waErrorAlert"   class="alert alert-danger"  style="display:none;margin-top:10px;"></div>
            </div>

            <div class="modal-footer">
                <span class="text-muted" id="waSendProgress" style="float:left;font-size:13px;padding-top:8px;"></span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="waAttendSendBtn" class="btn btn-success btn-lg" onclick="waSendAttendance()">
                    <i class="fa fa-whatsapp"></i> Send Messages
                </button>
            </div>
        </div>
    </div>
</div>


<!-- ================================================================
     MODAL 2 — TEMPLATE EDITOR
================================================================ -->
<div class="modal fade" id="waAttendTplModal" tabindex="-1" role="dialog" style="z-index:1060;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header" style="background:#128C7E;color:#fff;border-radius:4px 4px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:1;"><span>×</span></button>
                <h4 class="modal-title"><i class="fa fa-pencil"></i> Edit Attendance WhatsApp Template</h4>
            </div>

            <div class="modal-body">
                <div style="margin-bottom:14px;">
                    <label style="font-weight:600;margin-right:10px;">Template for:</label>
                    <div class="btn-group" id="tplTypeGroup">
                        <button type="button" class="btn btn-danger btn-sm active" onclick="waAttTplSwitch('absent')">
                            <i class="fa fa-times-circle"></i> Absent Message
                        </button>
                        <button type="button" class="btn btn-success btn-sm" onclick="waAttTplSwitch('present')">
                            <i class="fa fa-check-circle"></i> Present Message
                        </button>
                    </div>
                    <span class="text-muted" style="font-size:12px;margin-left:10px;" id="tplTypeSavedNote"></span>
                </div>

                <div class="form-group">
                    <label><strong>Available Variables</strong>
                        <small class="text-muted"> — click to insert at cursor</small>
                    </label>
                    <div>
                        <?php
                        $att_vars = [
                            '{{student_name}}' => 'Student Name',
                            '{{admission_no}}' => 'Admission No',
                            '{{roll_no}}'      => 'Roll No',
                            '{{date}}'         => 'Attendance Date',
                            '{{class}}'        => 'Class',
                            '{{section}}'      => 'Section',
                            '{{father_name}}'  => 'Father Name',
                            '{{mobileno}}'     => 'Mobile No',
                        ];
                        foreach ($att_vars as $var => $label) : ?>
                            <button type="button" class="btn btn-xs btn-primary" style="margin:2px 2px 4px 0;"
                                    onclick="waAttInsertVar('<?php echo $var; ?>')">
                                <?php echo $var; ?>
                                <small style="opacity:.8;">(<?php echo $label; ?>)</small>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    <small class="text-muted">
                        WhatsApp formatting: <code>*bold*</code> &nbsp;
                        <code>_italic_</code> &nbsp; <code>~strikethrough~</code>
                    </small>
                </div>

                <div class="form-group">
                    <label><strong>Quick Load Default:</strong></label>&nbsp;
                    <button type="button" class="btn btn-xs btn-default" onclick="waAttLoadDefault('gujarati')">🇮🇳 Gujarati</button>
                    <button type="button" class="btn btn-xs btn-default" onclick="waAttLoadDefault('english')">🇬🇧 English</button>
                    <button type="button" class="btn btn-xs btn-default" onclick="waAttLoadDefault('hindi')">🇮🇳 Hindi</button>
                </div>

                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label><strong>Message Template:</strong></label>
                            <textarea id="waAttTplText" class="form-control" rows="12"
                                      style="font-family:monospace;font-size:13px;resize:vertical;"
                                      placeholder="Write your WhatsApp message here..."
                                      oninput="waAttRefreshPreview()"></textarea>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label><strong><i class="fa fa-mobile"></i> Live Preview</strong>
                            <small class="text-muted"> (sample data)</small>
                        </label>
                        <div style="background:#ECE5DD;padding:12px;border-radius:6px;min-height:220px;">
                            <div style="background:#fff;border-radius:8px;padding:12px;box-shadow:0 1px 2px rgba(0,0,0,.2);max-width:280px;">
                                <pre id="waAttTplPreview"
                                     style="font-size:12px;white-space:pre-wrap;margin:0;font-family:inherit;background:transparent;border:none;padding:0;">Loading...</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="waAttTplSaveBtn" class="btn btn-success" onclick="waAttSaveTemplate()">
                    <i class="fa fa-save"></i> Save Template
                </button>
            </div>
        </div>
    </div>
</div>


<!-- ================================================================
     JAVASCRIPT — SEND MODAL
================================================================ -->
<script>
var waCurrentFilter = 'absent';

function waGetFiltered() {
    return waAllStudents.filter(function(s) {
        if (s.date_marked === 'xxx') return false;
        if (waCurrentFilter === 'absent')  return s.attendence_type_id != 1;
        if (waCurrentFilter === 'present') return s.attendence_type_id == 1;
        return true;
    });
}

function waSetFilter(f) {
    waCurrentFilter = f;
    $('#waFilterGroup button').removeClass('active');
    var idx = {absent: 0, present: 1, all: 2}[f];
    $('#waFilterGroup button').eq(idx).addClass('active');
    waRenderTable();
    waLoadPreview();
}

function waRenderTable() {
    var students = waGetFiltered();
    var html = '';
    students.forEach(function(s, i) {
        var badge = s.attendence_type_id == 1
            ? '<span class="label label-success">Present</span>'
            : '<span class="label label-danger">Absent</span>';

        var phoneBadge = s.parent_phone
            ? '<small class="text-success"><i class="fa fa-check"></i> ' + s.parent_phone + '</small>'
            : '<small class="text-danger"><i class="fa fa-times"></i> No mobile</small>';

        var safeName   = s.name.replace(/"/g, '&quot;');
        var safeFather = (s.father_name || '').replace(/"/g, '&quot;');

        html += '<tr id="waRow_' + s.student_session_id + '">'
            + '<td><input type="checkbox" class="waStudentChk"'
            +     ' value="'         + s.student_session_id + '"'
            +     ' data-type="'     + s.attendence_type_id + '"'
            +     ' data-phone="'    + s.parent_phone + '"'
            +     ' data-name="'     + safeName + '"'
            +     ' data-adm="'      + s.admission_no + '"'
            +     ' data-roll="'     + s.roll_no + '"'
            +     ' data-father="'   + safeFather + '"'
            +     ' data-mobileno="' + s.parent_phone + '"'
            +     (s.parent_phone ? '' : ' disabled')
            +     ' checked></td>'
            + '<td>' + (i + 1) + '</td>'
            + '<td>' + s.name + '</td>'
            + '<td>' + s.admission_no + '</td>'
            + '<td>' + badge + '</td>'
            + '<td>' + phoneBadge + '</td>'
            + '<td><span id="waStatus_' + s.student_session_id + '" class="label label-default">'
            +     (s.parent_phone ? 'Pending' : 'No mobile') + '</span></td>'
            + '</tr>';
    });

    if (!html) {
        html = '<tr><td colspan="7" class="text-center text-muted" style="padding:16px;">No students match this filter</td></tr>';
    }

    $('#waStudentTableBody').html(html);
    $('#waFilterCount').text(students.length + ' student(s)');
    $('#waSelectAll').prop('checked', true);
}

function waToggleAll(cb) {
    $('.waStudentChk').prop('checked', $(cb).is(':checked'));
}

function waLoadPreview() {
    $('#waAttendPreview').text('Loading...');
    $.ajax({
        url:      waSiteUrl + 'admin/stuattendence/get_attendance_wa_template',
        type:     'GET',
        data:     { filter: waCurrentFilter },
        dataType: 'json',
        success: function(res) {
            var tpl = res.template || 'Template not set.';
            $('#waAttendPreview').text(
                tpl.replace(/\{\{student_name\}\}/g, 'Jay Sharma')
                   .replace(/\{\{date\}\}/g,         waDate)
                   .replace(/\{\{admission_no\}\}/g, 'ADM001')
                   .replace(/\{\{roll_no\}\}/g,      '5')
                   .replace(/\{\{class\}\}/g,        'Class 1')
                   .replace(/\{\{section\}\}/g,      'A')
                   .replace(/\{\{father_name\}\}/g,  'Ramesh Sharma')
                   .replace(/\{\{mobileno\}\}/g,     '9876543210')
            );
        },
        error: function() { $('#waAttendPreview').text('Could not load preview.'); }
    });
}

function openWAAttendanceModal() {
    waCurrentFilter = 'absent';
    $('#waFilterGroup button').removeClass('active');
    $('#waFilterGroup button').eq(0).addClass('active');
    $('#waSuccessAlert, #waErrorAlert').hide();
    $('#waSendProgress').text('');
    $('#waAttendSendBtn').prop('disabled', false)
        .html('<i class="fa fa-whatsapp"></i> Send Messages');
    waRenderTable();
    waLoadPreview();
    $('#waAttendanceModal').modal('show');
}

function waSendAttendance() {
    var selected = [];
    $('.waStudentChk:checked').each(function() {
        selected.push({
            id:       $(this).val(),
            type:     $(this).data('type'),
            phone:    $(this).data('phone'),
            name:     $(this).data('name'),
            adm:      $(this).data('adm'),
            roll:     $(this).data('roll'),
            father:   $(this).data('father'),
            mobileno: $(this).data('mobileno'),
        });
    });

    if (selected.length === 0) {
        alert('Please select at least one student.');
        return;
    }

    $('#waAttendSendBtn').prop('disabled', true)
        .html('<i class="fa fa-spinner fa-spin"></i> Sending...');
    $('#waSuccessAlert, #waErrorAlert').hide();

    var idx = 0, sent = 0, failed = 0;

    function sendNext() {
        if (idx >= selected.length) {
            $('#waAttendSendBtn').prop('disabled', false)
                .html('<i class="fa fa-whatsapp"></i> Send Messages');
            $('#waSendProgress').text('');
            $('#waSuccessAlert')
                .text('Done! Sent: ' + sent + '  |  Failed/No mobile: ' + failed)
                .show();
            return;
        }

        var s = selected[idx];
        $('#waSendProgress').text('Sending ' + (idx + 1) + ' of ' + selected.length + '...');

        var postData = {};
        postData[waCsrfName]           = waCsrfHash;
        postData['student_session_id'] = s.id;
        postData['attendence_type_id'] = s.type;
        postData['date']               = waDate;
        postData['parent_phone']       = s.phone;
        postData['student_name']       = s.name;
        postData['admission_no']       = s.adm;
        postData['roll_no']            = s.roll;
        postData['father_name']        = s.father;
        postData['mobileno']           = s.mobileno;
        postData['class_id']           = '<?php echo $class_id; ?>';
        postData['section_id']         = '<?php echo $section_id; ?>';

        $.ajax({
            url:      waSiteUrl + 'admin/stuattendence/send_attendance_whatsapp',
            type:     'POST',
            data:     postData,
            dataType: 'json',
            success: function(res) {
                var statusEl = $('#waStatus_' + s.id);
                if (res.success) {
                    statusEl.removeClass().addClass('label label-success').text('Sent');
                    sent++;
                } else {
                    statusEl.removeClass().addClass('label label-warning').text(res.message || 'Failed');
                    failed++;
                }
                if (res.csrf) waCsrfHash = res.csrf;
                idx++;
                sendNext();
            },
            error: function() {
                $('#waStatus_' + s.id).removeClass().addClass('label label-danger').text('Error');
                failed++;
                idx++;
                sendNext();
            }
        });
    }

    sendNext();
}
</script>


<!-- ================================================================
     JAVASCRIPT — TEMPLATE EDITOR MODAL
================================================================ -->
<script>
var waAttDefaults = {
    absent: {
        gujarati:
"🔴 *ગેરહાજરી સૂચના*\n" +
"────────────────\n" +
"👤 વિદ્યાર્થી: {{student_name}}\n" +
"📋 એડ્મ. નં: {{admission_no}}\n" +
"🎓 રોલ નં: {{roll_no}}\n" +
"📅 તારીખ: {{date}}\n" +
"🏫 વર્ગ: {{class}} - {{section}}\n" +
"👨 પિતા: {{father_name}}\n\n" +
"આપના બાળક આજે શાળામાં *ગેરહાજર* રહ્યા છે.\n" +
"કૃપા કરીને શાળાનો સંપર્ક કરો.\n\n" +
"_EduRoot School Management_",
        english:
"🔴 *Absence Notification*\n" +
"────────────────\n" +
"👤 Student: {{student_name}}\n" +
"📋 Adm No: {{admission_no}}\n" +
"🎓 Roll No: {{roll_no}}\n" +
"📅 Date: {{date}}\n" +
"🏫 Class: {{class}} - {{section}}\n" +
"👨 Father: {{father_name}}\n\n" +
"Your ward was *ABSENT* from school today.\n" +
"Please contact the school for more information.\n\n" +
"_EduRoot School Management_",
        hindi:
"🔴 *अनुपस्थिति सूचना*\n" +
"────────────────\n" +
"👤 छात्र: {{student_name}}\n" +
"📋 प्रवेश संख्या: {{admission_no}}\n" +
"🎓 रोल नं: {{roll_no}}\n" +
"📅 दिनांक: {{date}}\n" +
"🏫 कक्षा: {{class}} - {{section}}\n" +
"👨 पिता: {{father_name}}\n\n" +
"आपका बच्चा आज विद्यालय में *अनुपस्थित* रहा है।\n" +
"कृपया विद्यालय से संपर्क करें।\n\n" +
"_EduRoot School Management_"
    },
    present: {
        gujarati:
"✅ *હાજરી સૂચના*\n" +
"────────────────\n" +
"👤 વિદ્યાર્થી: {{student_name}}\n" +
"📋 એડ્મ. નં: {{admission_no}}\n" +
"🎓 રોલ નં: {{roll_no}}\n" +
"📅 તારીખ: {{date}}\n" +
"🏫 વર્ગ: {{class}} - {{section}}\n" +
"👨 પિતા: {{father_name}}\n\n" +
"આપના બાળક આજે શાળામાં *હાજર* છે.\n\n" +
"_EduRoot School Management_",
        english:
"✅ *Attendance Notification*\n" +
"────────────────\n" +
"👤 Student: {{student_name}}\n" +
"📋 Adm No: {{admission_no}}\n" +
"🎓 Roll No: {{roll_no}}\n" +
"📅 Date: {{date}}\n" +
"🏫 Class: {{class}} - {{section}}\n" +
"👨 Father: {{father_name}}\n\n" +
"Your ward is *PRESENT* in school today.\n\n" +
"_EduRoot School Management_",
        hindi:
"✅ *उपस्थिति सूचना*\n" +
"────────────────\n" +
"👤 छात्र: {{student_name}}\n" +
"📋 प्रवेश संख्या: {{admission_no}}\n" +
"🎓 रोल नं: {{roll_no}}\n" +
"📅 दिनांक: {{date}}\n" +
"🏫 कक्षा: {{class}} - {{section}}\n" +
"👨 पिता: {{father_name}}\n\n" +
"आपका बच्चा आज विद्यालय में *उपस्थित* है।\n\n" +
"_EduRoot School Management_"
    }
};

var waAttCurrentTplType = 'absent';

var waAttSample = {
    student_name: 'Jay Sharma',
    admission_no: 'ADM001',
    roll_no:      '5',
    date:         waDate,
    class:        'Class 1',
    section:      'A',
    father_name:  'Ramesh Sharma',
    mobileno:     '9876543210',
};

function waAttBuildPreview(tpl) {
    var msg = tpl;
    Object.keys(waAttSample).forEach(function(k) {
        msg = msg.split('{{' + k + '}}').join(waAttSample[k]);
    });
    return msg;
}

function waAttRefreshPreview() {
    $('#waAttTplPreview').text(waAttBuildPreview($('#waAttTplText').val()));
}

function waAttTplSwitch(type) {
    waAttCurrentTplType = type;
    $('#tplTypeGroup button').removeClass('active');
    $('#tplTypeGroup button').eq(type === 'absent' ? 0 : 1).addClass('active');
    $('#tplTypeSavedNote').text('');

    var dbType = type === 'absent' ? 'student_absent_attendence' : 'student_present_attendence';
    var postData = { type: dbType };
    postData[waCsrfName] = waCsrfHash;

    $.ajax({
        url:      waSiteUrl + 'admin/stuattendence/getAttendanceWATemplate',
        type:     'POST',
        data:     postData,
        dataType: 'json',
        success: function(res) {
            $('#waAttTplText').val((res.template && res.template.trim()) ? res.template : waAttDefaults[type].gujarati);
            waAttRefreshPreview();
        },
        error: function() {
            $('#waAttTplText').val(waAttDefaults[type].gujarati);
            waAttRefreshPreview();
        }
    });
}

function openWAAttendTplModal() {
    waAttCurrentTplType = 'absent';
    $('#tplTypeGroup button').removeClass('active');
    $('#tplTypeGroup button').eq(0).addClass('active');
    $('#tplTypeSavedNote').text('');
    $('#waAttTplSaveBtn').prop('disabled', false).html('<i class="fa fa-save"></i> Save Template');
    waAttTplSwitch('absent');
    $('#waAttendTplModal').modal('show');
}

function waAttInsertVar(ph) {
    var el = document.getElementById('waAttTplText');
    var s = el.selectionStart, e = el.selectionEnd;
    el.value = el.value.substring(0, s) + ph + el.value.substring(e);
    el.selectionStart = el.selectionEnd = s + ph.length;
    el.focus();
    waAttRefreshPreview();
}

function waAttLoadDefault(lang) {
    $('#waAttTplText').val(waAttDefaults[waAttCurrentTplType][lang]);
    waAttRefreshPreview();
}

function waAttSaveTemplate() {
    var tpl = $.trim($('#waAttTplText').val());
    if (!tpl) { alert('Please enter a template!'); return; }

    var dbType = waAttCurrentTplType === 'absent' ? 'student_absent_attendence' : 'student_present_attendence';

    $('#waAttTplSaveBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

    var postData = { type: dbType, template: tpl };
    postData[waCsrfName] = waCsrfHash;

    $.ajax({
        url:      waSiteUrl + 'admin/stuattendence/saveAttendanceWATemplate',
        type:     'POST',
        data:     postData,
        dataType: 'json',
        success: function(res) {
            if (res.status == 1) {
                $('#tplTypeSavedNote').html('<span class="text-success"><i class="fa fa-check"></i> Saved!</span>');
                if (res.csrf) waCsrfHash = res.csrf;
            } else {
                alert('Error saving: ' + (res.message || 'Unknown error'));
            }
        },
        error: function() { alert('Server error. Please try again.'); },
        complete: function() {
            $('#waAttTplSaveBtn').prop('disabled', false).html('<i class="fa fa-save"></i> Save Template');
        }
    });
}
</script>

<?php } // end if resultlist ?>


<!-- ================================================================
     EXISTING PAGE SCRIPTS (unchanged)
================================================================ -->
<script type="text/javascript">
    $(document).ready(function() {
        displayDataTable('myexample', [], 50,
            [{
                    targets: [0],
                    orderable: true,
                    className: 'dt-body-left dt-head-left'
                },
                {
                    targets: [-1],
                    orderable: false,
                    className: 'dt-body-right dt-head-right'
                }
            ]);
    });

    $(document).ready(function() {
        var section_id_post = '<?php echo $section_id; ?>';
        var class_id_post   = '<?php echo $class_id; ?>';
        populateSection(section_id_post, class_id_post);

        function populateSection(section_id_post, class_id_post) {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: { 'class_id': class_id_post },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(i, obj) {
                        var select = "";
                        if (section_id_post == obj.section_id) { select = "selected=selected"; }
                        div_data += "<option value=" + obj.section_id + " " + select + ">" + obj.section + "</option>";
                    });
                    $('#section_id').html(div_data);
                }
            });
        }

        $(document).on('change', '#class_id', function(e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: { 'class_id': class_id, 'day_wise': 'yes' },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(i, obj) {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });
                    $('#section_id').html(div_data);
                }
            });
        });
    });
</script>