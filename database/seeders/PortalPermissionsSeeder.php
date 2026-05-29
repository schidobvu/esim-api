<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PortalPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::add('portal.login.portal.user', 'portal/auth/login', 'POST', 'Login Portal Users', 'Portal Login');
        Permission::add('portal.logout.portal.user', 'portal/auth/logout', 'DELETE', 'Logout Portal Users', 'Portal Logout');

        Permission::add('portal.create.portal.user', 'portal/portal-users', 'POST', 'Create Portal Users', 'Portal Users');
        Permission::add('portal.update.portal.user', 'portal/portal-users/{user}', 'PATCH', 'Update Portal Users', 'Portal Users');
        Permission::add('portal.block.portal.user', 'portal/portal-users/{user}/block', 'PATCH', 'Block Portal Users', 'Portal Users');
        Permission::add('portal.unblock.portal.user', 'portal/portal-users/{user}/unblock', 'PATCH', 'Unblock Portal Users', 'Portal Users');
        Permission::add('portal.list.portal.users', 'portal/portal-users', 'GET', 'List Portal Users', 'Portal Users');
        Permission::add('portal.get.portal.user', 'portal/portal-users/{user}', 'GET', 'Get Portal Users', 'Portal Users');


        Permission::add('portal.create.role', 'portal/roles', 'POST', 'Create Roles', 'Roles');
        Permission::add('portal.update.role', 'portal/roles/{role}', 'PATCH', 'Update Role', 'Roles');
        Permission::add('portal.clone.role', 'portal/roles/{role}/clone', 'POST', 'Clone Role', 'Roles');
        Permission::add('portal.update.role.permission', 'portal/roles/{role}/permissions/{permission}', 'PUT', 'Assign Permission To Role', 'Roles');
        Permission::add('portal.delete.role.permission', 'portal/roles/{role}/permissions/{permission}', 'DELETE', 'Remove Permission from Role', 'Roles');
        Permission::add('portal.block.role', 'portal/roles/{role}/block', 'PATCH', 'Block Role', 'Roles');
        Permission::add('portal.unblock.role', 'portal/roles/{role}/unblock', 'PATCH', 'Unblock Role', 'Roles');
        Permission::add('portal.list.roles', 'portal/roles', 'GET', 'List Roles', 'Roles');
        Permission::add('portal.get.role', 'portal/roles/{role}', 'GET', 'Get Role', 'Roles');

        Permission::add('portal.get.permission', 'portal/permissions/{permission}', 'GET', 'Get Permission', 'Permissions');
        Permission::add('portal.create.permission', 'portal/permissions', 'POST', 'Create Permission', 'Permissions');
        Permission::add('portal.update.permission', 'portal/permissions/{permission}', 'PATCH', 'Update Permission', 'Permissions');
        Permission::add('portal.list.permissions', 'portal/permissions', 'GET', 'List Permissions', 'Permissions');
        Permission::add('portal.delete.permission', 'portal/permissions/{permission}', 'DELETE', 'Delete Permission', 'Permissions');

        Permission::add('portal.create.actor', 'portal/actors', 'POST', 'Create Actors', 'Actors');
        Permission::add('portal.update.actor', 'portal/actors/{actor}', 'PATCH', 'Update Actor', 'Actors');
        Permission::add('portal.update.actor.user', 'portal/actors/{actor}/users/{portalUser}', 'PUT', 'Assign User To Actor', 'Actors');
        Permission::add('portal.delete.actor.user', 'portal/actors/{actor}/users/{portalUser}', 'DELETE', 'Remove User from Actor', 'Actors');
        Permission::add('portal.block.actor', 'portal/actors/{actor}/block', 'PATCH', 'Block Actor', 'Actors');
        Permission::add('portal.unblock.actor', 'portal/actors/{actor}/unblock', 'PATCH', 'Unblock Actor', 'Actors');
        Permission::add('portal.list.actors', 'portal/actors', 'GET', 'List Actors', 'Actors');
        Permission::add('portal.get.actor', 'portal/actors/{actor}', 'GET', 'Get Actor', 'Actors');

        Permission::add('portal.create.approver.group', 'portal/approver-groups', 'POST', 'Create Approver Groups', 'Approver Groups');
        Permission::add('portal.update.approver.group', 'portal/approver-groups/{approverGroup}', 'PATCH', 'Update Approver Group', 'Approver Groups');
        Permission::add('portal.update.approver.group.user', 'portal/approver-groups/{approverGroup}/users/{portalUser}', 'PUT', 'Assign User To ApproverGroup', 'Approver Groups');
        Permission::add('portal.delete.approver.group.user', 'portal/approver-groups/{approverGroup}/users/{portalUser}', 'DELETE', 'Remove User from Approver Group', 'Approver Groups');
        Permission::add('portal.block.approver.group', 'portal/approver-groups/{approverGroup}/block', 'PATCH', 'Block Approver Group', 'Approver Groups');
        Permission::add('portal.unblock.approver.group', 'portal/approver-groups/{approverGroup}/unblock', 'PATCH', 'Unblock Approver Group', 'Approver Groups');
        Permission::add('portal.list.approver.groups', 'portal/approver-groups', 'GET', 'List Approver Groups', 'Approver Groups');
        Permission::add('portal.get.approver.group', 'portal/approver-groups/{approverGroup}', 'GET', 'Get Approve rGroup', 'Approver Groups');


        Permission::add('portal.get.transition', 'portal/transitions/{transition}', 'GET', 'Get Transition', 'Transitions');
        Permission::add('portal.create.transition', 'portal/transitions', 'POST', 'Create Transition', 'Transitions');
        Permission::add('portal.update.transition', 'portal/transitions/{transition}', 'PATCH', 'Update Transition', 'Transitions');
        Permission::add('portal.list.transitions', 'portal/transitions', 'GET', 'List Transitions', 'Transitions');
        Permission::add('portal.delete.transition', 'portal/transitions/{transition}', 'DELETE', 'Delete Transition', 'Transitions');

        Permission::add('portal.get.process', 'portal/processes/{process}', 'GET', 'Get Process', 'Processes');
        Permission::add('portal.create.process', 'portal/processes', 'POST', 'Create Process', 'Processes');
        Permission::add('portal.update.process', 'portal/processes/{process}', 'PATCH', 'Update Process', 'Processes');
        Permission::add('portal.list.processes', 'portal/processes', 'GET', 'List Processes', 'Process');
        Permission::add('portal.delete.process', 'portal/processes/{process}', 'DELETE', 'Delete Process', 'Processes');
        Permission::add('portal.validate.process', 'portal/processes/{process}/validate', 'POST', 'Validate Process', 'Processes');

        Permission::add('portal.create.user.group', 'portal/user-groups', 'POST', 'Create User Groups', 'User Groups');
        Permission::add('portal.update.user.group', 'portal/user-groups/{userGroup}', 'PATCH', 'Update User Group', 'User Groups');
        Permission::add('portal.update.user.group.user', 'portal/user-groups/{userGroup}/users/{portalUser}', 'PUT', 'Assign User To User Group', 'User Groups');
        Permission::add('portal.delete.user.group.user', 'portal/user-groups/{userGroup}/users/{portalUser}', 'DELETE', 'Remove User from User Group', 'User Groups');
        Permission::add('portal.block.user.group', 'portal/user-groups/{userGroup}/block', 'PATCH', 'Block User Group', 'User Groups');
        Permission::add('portal.unblock.user.group', 'portal/user-groups/{userGroup}/unblock', 'PATCH', 'Unblock User Group', 'User Groups');
        Permission::add('portal.list.user.groups', 'portal/user-groups', 'GET', 'List User Groups', 'User Groups');
        Permission::add('portal.get.user.group', 'portal/user-groups/{userGroup}', 'GET', 'Get User Group', 'User Groups');


        Permission::add('portal.get.process.task', 'portal/process-tasks/{processTask}', 'GET', 'Get Process Task', 'Process Tasks');
        Permission::add('portal.create.process.task', 'portal/process-tasks', 'POST', 'Create Process Task', 'Process Tasks');
        Permission::add('portal.update.process.task', 'portal/process-tasks/{processTask}', 'PATCH', 'Update Process Task', 'Process Tasks');
        Permission::add('portal.mark.initiator.process.task', 'portal/process-tasks/{processTask}/mark-initiator', 'PATCH', 'Mark as initiator Process Task', 'Process Tasks');
        Permission::add('portal.mark.closing.process.task', 'portal/process-tasks/{processTask}/mark-closing', 'PATCH', 'Mark as closing Process Task', 'Process Tasks');
        Permission::add('portal.list.process.tasks', 'portal/process-tasks', 'GET', 'List Process Tasks', 'Process Tasks');
        Permission::add('portal.delete.process.task', 'portal/process-tasks/{processTask}', 'DELETE', 'Delete Process Task', 'Process Tasks');


        Permission::add('portal.get.process.task.instance', 'portal/process-task-instances/{processTaskInstance}', 'GET', 'Get Process Task Instance', 'Process Task Instances');
        Permission::add('portal.complete.process.task.instance', 'portal/process-task-instances/{processTaskInstance}/complete', 'PUT', 'Complete Process Task Instance', 'Process Task Instances');
        Permission::add('portal.save.process.task.instance.as.draft', 'portal/process-task-instances/{processTaskInstance}/save-as-draft', 'PUT', 'Save As Draft', 'Process Task Instances');
        Permission::add('portal.reject.process.task.instance', 'portal/process-task-instances/{processTaskInstance}/reject', 'PATCH', 'Reject Process Task Instance', 'Process Task Instances');
        Permission::add('portal.select.process.task.approver', 'portal/process-task-instances/{processTaskInstance}/select-approver', 'PATCH', 'Select Process Task Instance Approver', 'Process Task Instances');
        Permission::add('portal.change.process.task.assigned.user', 'portal/process-task-instances/{processTaskInstance}/change-assigned-user', 'PATCH', 'Change Process Task Assigned User', 'Process Task Instances');
        Permission::add('portal.list.process.task.instances', 'portal/process-task-instances', 'GET', 'List Process Task Instances', 'Process Task Instances');

        Permission::add('portal.get.process.case', 'portal/process-cases/{processCase}', 'GET', 'Get Process Case', 'Process Cases');
        Permission::add('portal.download.process.case.summary.pdf', 'portal/process-cases/{processCase}/download-summary-pdf', 'GET', 'Download Process Case Summary PDF', 'Process Cases');
        Permission::add('portal.create.process.case', 'portal/process-cases', 'POST', 'Create Process Case', 'Process Cases');
        Permission::add('portal.update.process.case', 'portal/process-cases/{processCase}', 'PATCH', 'Update Process Case', 'Process Cases');
        Permission::add('portal.close.process.case', 'portal/process-cases/{processCase}/close', 'PATCH', 'Close Process Case', 'Process Cases');
        Permission::add('portal.open.process.case', 'portal/process-cases/{processCase}/open', 'PATCH', 'Open Process Case', 'Process Cases');
        Permission::add('portal.list.process.cases', 'portal/process-cases', 'GET', 'List Process Cases', 'Process Cases');
        Permission::add('portal.delete.process.case', 'portal/process-cases/{processCase}', 'DELETE', 'Delete Process Case', 'Process Cases');


        Permission::add('portal.get.process.form', 'portal/process-forms/{processForm}', 'GET', 'Get Process Form', 'Process Forms');
        Permission::add('portal.create.process.form', 'portal/process-forms', 'POST', 'Create Process Form', 'Process Forms');
        Permission::add('portal.update.process.form', 'portal/process-forms/{processForm}', 'PATCH', 'Update Process Form', 'Process Forms');
        Permission::add('portal.list.process.forms', 'portal/process-forms', 'GET', 'List Process Forms', 'Process Forms');
        Permission::add('portal.delete.process.form', 'portal/process-forms/{processForm}', 'DELETE', 'Delete Process Form', 'Process Forms');

        Permission::add('portal.get.department', 'portal/departments/{department}', 'GET', 'Get Department', 'Departments');
        Permission::add('portal.create.department', 'portal/departments', 'POST', 'Create Department', 'Departments');
        Permission::add('portal.update.department', 'portal/departments/{department}', 'PATCH', 'Update Department', 'Departments');
        Permission::add('portal.list.departments', 'portal/departments', 'GET', 'List Departments', 'Departments');
        Permission::add('portal.delete.department', 'portal/departments/{department}', 'DELETE', 'Delete Department', 'Departments');

        Permission::add('portal.list.reports', 'portal/reports', 'GET', 'List Reports', 'Reports');

        Permission::add('portal.list.grades', 'portal/grades', 'GET', 'List Grades', 'Grades');

        Permission::add('portal.list.divisions', 'portal/divisions', 'GET', 'List Divisions', 'Divisions');

        Permission::add('portal.list.travel.allowance.rate.types', 'portal/travel-allowance-rate-types', 'GET', 'List Travel Allowance Rate Types', 'Travel Allowance Rate Types');

        Permission::add('portal.list.travel.allowance.rates', 'portal/travel-allowance-rates', 'GET', 'List Travel Allowance Rates', 'Travel Allowance Rates');

        Permission::add('portal.list.mpamba.transaction.fees', 'portal/mpamba-transaction-fees', 'GET', 'List Mpamba Transaction Fees', 'Mpamba Transaction Fees');

        Permission::add('portal.list.access.rights.apps', 'portal/access-rights-apps', 'GET', 'List Access Rights Apps', 'Access Rights Apps');

        Permission::add('portal.dashboard', 'portal/dashboard', 'GET', 'List Dashboard Stats', 'Dashboard');

        Permission::add('portal.guest.house.check.availability', 'portal/guest-house/check-availability', 'GET', 'Get Guest House Availability', 'Guest House');
        Permission::add('portal.guest.house.cities', 'portal/guest-house/cities', 'GET', 'Get Guest House Cities', 'Guest House');
        Permission::add('portal.guest.house.meta', 'portal/guest-house/meta', 'GET', 'Get Guest House Meta', 'Guest House');

        Permission::add('portal.get.guest.house.room.booking', 'portal/guest-house/bookings/{booking}', 'GET', 'Get Booking', 'Managers');
        Permission::add('portal.create.guest.house.room.booking', 'portal/guest-house/bookings', 'POST', 'Create Booking', 'Bookings');
        Permission::add('portal.update.guest.house.room.booking', 'portal/guest-house/bookings/{booking}', 'PATCH', 'Update Booking', 'Bookings');
        Permission::add('portal.list.guest.house.room.bookings', 'portal/guest-house/bookings', 'GET', 'List Bookings', 'Bookings');
        Permission::add('portal.delete.guest.house.room.booking', 'portal/guest-house/bookings/{booking}', 'DELETE', 'Delete Booking', 'Bookings');

        Permission::add('portal.get.manager', 'portal/managers/{manager}', 'GET', 'Get Manager', 'Managers');
        Permission::add('portal.create.manager', 'portal/managers', 'POST', 'Create Manager', 'Managers');
        Permission::add('portal.update.manager', 'portal/managers/{manager}', 'PATCH', 'Update Manager', 'Managers');
        Permission::add('portal.list.managers', 'portal/managers', 'GET', 'List Managers', 'Managers');
        Permission::add('portal.delete.manager', 'portal/managers/{manager}', 'DELETE', 'Delete Manager', 'Managers');

        Permission::add('portal.get.approver', 'portal/approvers/{approver}', 'GET', 'Get Approver', 'Approvers');
        Permission::add('portal.create.approver', 'portal/approvers', 'POST', 'Create Approver', 'Approvers');
        Permission::add('portal.update.approver', 'portal/approvers/{approver}', 'PATCH', 'Update Approver', 'Approvers');
        Permission::add('portal.list.approvers', 'portal/approvers', 'GET', 'List Approvers', 'Approvers');
        Permission::add('portal.delete.approver', 'portal/approvers/{approver}', 'DELETE', 'Delete Approver', 'Approvers');
    }
}
