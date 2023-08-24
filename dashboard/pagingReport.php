
    <table class="table table-bordered table-striped">
  <tbody>
    <tr>
   
      <td align="left">
      <button class="btn btn-default btn-block" onclick="window.location.href='?zone=<?=$zone?>&cmn_code=<?=$cmn_codex?>&current_month=<?=$current_month?>&current_year=<?=$current_year?>&page=<?=$page-1?>'">
      <img src="<?=base64_encode_image("../images/images_web/2.png")?>" >   
              </button>
      </td>
      <td align="center">
      <form method="get" name="search" id="search">
      <input type="hidden"  name="zone"  value="<?=$zone?>" >
      <input type="hidden"  name="cmn_code"  value="<?=$cmn_codex?>" >
      <input type="hidden"  name="current_month"  value="<?=$current_month?>" >
      <input type="hidden"  name="current_year"  value="<?=$current_year?>" >
    
      <input type="number"  name="page" style="width:150px; height:40px;font-size:20px;text-align: center;" value="<?=$page?>" onchange="submit();" >
      <input type="text" name="totalPage" style="width:150px; height:40px;font-size:20px;text-align: center;" value="<?=$total_page?> : <?=$total_data?>" disabled >
    </form>
      </td>
      <td align="right">
     
      <button class="btn btn-default btn-block" onclick="window.location.href='?zone=<?=$zone?>&cmn_code=<?=$cmn_codex?>&current_month=<?=$current_month?>&current_year=<?=$current_year?>&page=<?=$page+1?>'">
      <img src="<?=base64_encode_image("../images/images_web/Crystal_Project_Next.png")?>" >

              </button>   
      </td>
    </tr>
  </tbody>
</table>