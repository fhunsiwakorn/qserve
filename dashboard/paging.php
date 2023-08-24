
    <table class="table table-bordered table-striped">
  <tbody>
    <tr>
   
      <td align="left">
      <button type="button" class="btn btn-default btn-block" onclick="window.location.href='?zone=<?=$zone?>&page=<?=$page-1?>&q=<?=$q?>'">
      <img src="<?=base64_encode_image("../images/images_web/2.png")?>" >   
              </button>
      </td>
      <td align="center">
      <form method="get" >
      <!-- <input type="hidden"  name="zone"  value="<?=$zone?>" > -->
      <input type="number"  name="page" style="width:150px; height:40px;font-size:20px;text-align: center;" value="<?=$page?>" onchange="submit();" >
      <input type="text" name="totalPage" style="width:150px; height:40px;font-size:20px;text-align: center;" value="<?=$total_page?> : <?=$total_data?>" disabled >
    </form>
      </td>
      <td align="right">
     
      <button type="button" class="btn btn-default btn-block" onclick="window.location.href='?zone=<?=$zone?>&page=<?=$page+1?>&q=<?=$q?>'">
      <img src="<?=base64_encode_image("../images/images_web/Crystal_Project_Next.png")?>" >

              </button>   
      </td>
    </tr>
  </tbody>
</table>