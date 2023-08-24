
    <table class="table table-bordered table-striped">
  <tbody>
    <tr>
   
      <td align="left">
      <button class="btn btn-default btn-block" onclick="window.location.href='?eltp=<?=$eltp_code_get?>&page=<?=$page-1?>&q=<?=$q?>'">
      <img src="<?=base64_encode_image("../images/images_web/2.png")?>" style="height:20px; width:20px;">   
              </button>
      </td>
      <td align="center">
      <form method="get" name="search" id="search">
      <input type="hidden" name="eltp" value="<?=$eltp_code_get?>"  /> 
      <input type="number"  name="page" style="width:150px; height:40px;font-size:20px;text-align: center;" value="<?=$page?>" onchange="submit();" >
      <input type="text" name="totalPage" style="width:150px; height:40px;font-size:20px;text-align: center;" value="<?=$total_page?> : <?=$total_data?>" disabled >
    </form>
      </td>
      <td align="right">
     
      <button class="btn btn-default btn-block" onclick="window.location.href='?eltp=<?=$eltp_code_get?>&page=<?=$page+1?>&q=<?=$q?>'">
      <img src="<?=base64_encode_image("../images/images_web/Crystal_Project_Next.png")?>" style="height:20px; width:20px;">

              </button>   
      </td>
    </tr>
  </tbody>
</table>