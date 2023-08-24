<li class="nav-item">
            <a class="nav-link" href="?zone=main">
              <i class="menu-icon mdi mdi-home"></i>
              <span class="menu-title">
                <!-- หน้าหลัก -->
                <?=$auth_user->mf("9YUG6WTRXHO99SY5PAX3",$country_idx)?>
              </span>
            </a>
          </li>
        
       
          <li class="nav-item">
            <a class="nav-link" href="?zone=CategoryMain">
              <i class="menu-icon mdi mdi-folder"></i>
              <span class="menu-title"><?=$ctgm_name_main_x?></span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="?zone=CategorySub">
              <i class="menu-icon mdi mdi-folder-multiple"></i>
              <span class="menu-title"><?=$ctgs_name_main_x?></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?zone=Personal">
              <i class="menu-icon mdi mdi-account"></i>
              <span class="menu-title">
                <!-- บุคลากร/เจ้าหน้าที่ -->
                <?=$auth_user->mf("82BS90L39GV79H0CHXJ",$country_idx)?>
              </span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-library-books"></i>
              <span class="menu-title">
                <!-- ข้อมูลแบบประเมิน -->
                <?=$auth_user->mf("BB7A2P36J5V0Y95TVPA",$country_idx)?>
              </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="?zone=EvaluationForm1">
                    <!-- แบบฟอร์ม -->
                    <?=$auth_user->mf("QSSSELDILR7KC8J5DKM",$country_idx)?>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?zone=EvaluationData">
                    <!-- ข้อมูลแบบประเมิน -->
                    <?=$auth_user->mf("BB7A2P36J5V0Y95TVPA",$country_idx)?>
                  </a>
                </li>
            
              </ul>
            </div>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="?zone=Setting">
              <i class="menu-icon mdi mdi-sticker"></i>
              <span class="menu-title">
                <!-- เกี่ยวกับ -->
                <?=$auth_user->mf("UUUGA9M1X0QV1U04FEVR",$country_idx)?>
              </span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">หมวดหมู่ย่อย</span>
            </a>
          </li> -->
          