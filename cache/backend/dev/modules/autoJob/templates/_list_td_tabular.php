<td class="sf_admin_text sf_admin_list_td_active">
  <?php echo $JobeetJob->getActive() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_category">
  <?php echo $JobeetJob->getCategory() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_company">
  <?php echo $JobeetJob->getCompany() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_email">
  <?php echo $JobeetJob->getEmail() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_position">
  <?php echo link_to($JobeetJob->getPosition(), 'jobeet_job_edit', $JobeetJob) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_location">
  <?php echo $JobeetJob->getLocation() ?>
</td>
