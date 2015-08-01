var Groups = {
    init: function() {
        Groups.$buttons = {
            buttons: $('.groups button'),
            groups: $('.groups button.group'),
            all: $('.groups button.all'),
            add: $('.groups button.add'),
            onoff: $('.groups .onoffswitch')
        };
        Groups.$table = $('table.spikers');

        var $onoffbox = Groups.$buttons.onoff.find('input');
        var id = $onoffbox.attr('id').replace('onoff-','');
        if (id != null) {
            Groups.statusToggle($onoffbox, id);
        }

        Groups.list();
    },

    list: function() {
        Groups.$buttons.buttons.click(function () {
            if (!$(this).hasClass('add')) {
                Groups.$buttons.buttons.removeClass('btn-primary').addClass('btn-default');
                $(this).removeClass('btn-default').addClass('btn-primary');
            }
        });

        Groups.$buttons.all.click(function() {
            Groups.$buttons.onoff.hide();
            Groups.$table.find('tr.spiker').show();
            $('.spiker-numbers .group').html(Groups.$table.find('tr.spiker').length);
        });
        Groups.$buttons.groups.click(function() {
            var id = $(this).attr('id').replace('group-','');
            $.get(Routing.generate('group_status_check', {id:id}), function (data) {
                if (data) {
                    var $onoffbox = Groups.$buttons.onoff.find('input');
                    if (data.enabled) {
                        $onoffbox.unbind().prop('checked', true);
                    } else {
                        $onoffbox.unbind().prop('checked', false);
                    }
                    Groups.statusToggle($onoffbox, id);
                }
            });
            Groups.$buttons.onoff.show();
            Groups.$table.find('tr.spiker').hide();
            Groups.$table.find('tr.group-'+id.toString()).show();
            $('.spiker-numbers .group').html(Groups.$table.find('tr.group-'+id.toString()).length);
        });
        Groups.$buttons.add.click(function() {
            if (confirm("Are you sure you want to add another group?\nYou will not be able to remove it once it is created.") == true) {
                window.location.replace(Routing.generate('group_new'));
            }
        });
    },

    statusToggle: function($onoffbox, id) {
        var nextStatus = ($onoffbox.prop('checked')) ? 0 : 1;
        $onoffbox.change(function() {
            $.get(Routing.generate('group_status_set', {id:id, status:nextStatus} ));
            $onoffbox.unbind();
            Groups.statusToggle($onoffbox, id);
            if (nextStatus) {
                Groups.$table.find('tr.group-'+id.toString()+' input').prop('disabled', false);
                Groups.$table.find('tr.group-'+id.toString()).removeClass('disabled');
            } else {
                Groups.$table.find('tr.group-'+id.toString()+' input').prop('disabled', true);
                Groups.$table.find('tr.group-'+id.toString()).addClass('disabled');
            }
        })
    }
};