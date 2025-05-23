<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <a href="<?= base_url() ;?>penjualan/tambahreturpenjualan"><button id="" class="btn btn-primary"> <i class="fas fa-truck-loading"></i> Tambah Retur</button></a>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-3 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="kodeitemdiskon">Parameter Pencarian</label>
                                <select class="selectpicker" data-live-search="true">
                                    <option> No Transakasi</option>
                                    <option> Kode Item</option>
                                    <option> Nama Barang</option>
                                    <option> Nama Member</option>
                                </select>
                                <!-- END Select -->
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label for="kodeitemdiskon">Kata Kunci</label>
                                <input type="text" class="form-control" id="kodeitemdiskon"
                                    placeholder="Masukan kata kunci yang anda inginkan">
                            </div>
                            <div class="col-md-5 mb-1 col-sm-12">
                                <label>Tentukan Tanggal Transaksi</label>
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" placeholder="Dari Tanggal">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Sampai Tanggal">
                                </div>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="datatable-1" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Card ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>ZIP</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>629047</td>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>(356) 503-9946</td>
                                    <td>gozer@gmail.com</td>
                                    <td>Germany</td>
                                    <td>Berlin</td>
                                    <td>41018</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>629547</td>
                                    <td>Garrett Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>63</td>
                                    <td>(968) 611-6370</td>
                                    <td>tfinniga@att.net</td>
                                    <td>Iran</td>
                                    <td>Ahvaz</td>
                                    <td>60201</td>
                                    <td>2011/07/25</td>
                                    <td>$170,750</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>129547</td>
                                    <td>Ashton Cox</td>
                                    <td>Junior Technical Author</td>
                                    <td>San Francisco</td>
                                    <td>66</td>
                                    <td>(406) 407-7149</td>
                                    <td>parasite@att.net</td>
                                    <td>Tunisia</td>
                                    <td>Tunis</td>
                                    <td>27587</td>
                                    <td>2009/01/12</td>
                                    <td>$86,000</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>129567</td>
                                    <td>Cedric Kelly</td>
                                    <td>Senior Javascript Developer</td>
                                    <td>Edinburgh</td>
                                    <td>22</td>
                                    <td>(529) 403-6823</td>
                                    <td>ramollin@att.net</td>
                                    <td>India</td>
                                    <td>Ahmedabad</td>
                                    <td>10573</td>
                                    <td>2012/03/29</td>
                                    <td>$433,060</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>429567</td>
                                    <td>Airi Satou</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>33</td>
                                    <td>(280) 745-0595</td>
                                    <td>luvirini@icloud.com</td>
                                    <td>China</td>
                                    <td>Shanghai</td>
                                    <td>14450</td>
                                    <td>2008/11/28</td>
                                    <td>$162,700</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>829567</td>
                                    <td>Brielle Williamson</td>
                                    <td>Integration Specialist</td>
                                    <td>New York</td>
                                    <td>61</td>
                                    <td>(801) 567-9532</td>
                                    <td>guialbu@hotmail.com</td>
                                    <td>Senegal</td>
                                    <td>Dakar</td>
                                    <td>92806</td>
                                    <td>2012/12/02</td>
                                    <td>$372,000</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>819067</td>
                                    <td>Herrod Chandler</td>
                                    <td>Sales Assistant</td>
                                    <td>San Francisco</td>
                                    <td>59</td>
                                    <td>(797) 203-3943</td>
                                    <td>melnik@comcast.net</td>
                                    <td>China</td>
                                    <td>Chengdu</td>
                                    <td>34293</td>
                                    <td>2012/08/06</td>
                                    <td>$137,500</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>019067</td>
                                    <td>Rhona Davidson</td>
                                    <td>Integration Specialist</td>
                                    <td>Tokyo</td>
                                    <td>55</td>
                                    <td>(658) 817-0095</td>
                                    <td>wkrebs@att.net</td>
                                    <td>Singapore</td>
                                    <td>Singapore</td>
                                    <td>55068</td>
                                    <td>2010/10/14</td>
                                    <td>$327,900</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>815667</td>
                                    <td>Colleen Hurst</td>
                                    <td>Javascript Developer</td>
                                    <td>San Francisco</td>
                                    <td>39</td>
                                    <td>(955) 413-5988</td>
                                    <td>grinder@sbcglobal.net</td>
                                    <td>Japan</td>
                                    <td>Nagoya</td>
                                    <td>60188</td>
                                    <td>2009/09/15</td>
                                    <td>$205,500</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>815067</td>
                                    <td>Sonya Frost</td>
                                    <td>Software Engineer</td>
                                    <td>Edinburgh</td>
                                    <td>23</td>
                                    <td>(407) 532-2374</td>
                                    <td>graham@mac.com</td>
                                    <td>Canada</td>
                                    <td>Toronto</td>
                                    <td>08060</td>
                                    <td>2008/12/13</td>
                                    <td>$103,600</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>815227</td>
                                    <td>Jena Gaines</td>
                                    <td>Office Manager</td>
                                    <td>London</td>
                                    <td>30</td>
                                    <td>(233) 299-4959</td>
                                    <td>hllam@yahoo.ca</td>
                                    <td>Pakistan</td>
                                    <td>Gujranwala</td>
                                    <td>54449</td>
                                    <td>2008/12/19</td>
                                    <td>$90,560</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>815927</td>
                                    <td>Quinn Flynn</td>
                                    <td>Support Lead</td>
                                    <td>Edinburgh</td>
                                    <td>22</td>
                                    <td>(367) 662-1783</td>
                                    <td>dgriffith@mac.com</td>
                                    <td>Philippines</td>
                                    <td>Quezon City</td>
                                    <td>89523</td>
                                    <td>2013/03/03</td>
                                    <td>$342,000</td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td>816927</td>
                                    <td>Charde Marshall</td>
                                    <td>Regional Director</td>
                                    <td>San Francisco</td>
                                    <td>36</td>
                                    <td>(928) 933-1039</td>
                                    <td>north@me.com</td>
                                    <td>United States</td>
                                    <td>New York City</td>
                                    <td>54481</td>
                                    <td>2008/10/16</td>
                                    <td>$470,600</td>
                                </tr>
                                <tr>
                                    <td>14</td>
                                    <td>116927</td>
                                    <td>Haley Kennedy</td>
                                    <td>Senior Marketing Designer</td>
                                    <td>London</td>
                                    <td>43</td>
                                    <td>(565) 972-1929</td>
                                    <td>mbrown@sbcglobal.net</td>
                                    <td>India</td>
                                    <td>Ahmedabad</td>
                                    <td>29526</td>
                                    <td>2012/12/18</td>
                                    <td>$313,500</td>
                                </tr>
                                <tr>
                                    <td>15</td>
                                    <td>112907</td>
                                    <td>Tatyana Fitzpatrick</td>
                                    <td>Regional Director</td>
                                    <td>London</td>
                                    <td>19</td>
                                    <td>(567) 660-2663</td>
                                    <td>dougj@aol.com</td>
                                    <td>India</td>
                                    <td>Pune</td>
                                    <td>14606</td>
                                    <td>2010/03/17</td>
                                    <td>$385,750</td>
                                </tr>
                                <tr>
                                    <td>16</td>
                                    <td>218907</td>
                                    <td>Michael Silva</td>
                                    <td>Marketing Designer</td>
                                    <td>London</td>
                                    <td>66</td>
                                    <td>(703) 888-3062</td>
                                    <td>niknejad@sbcglobal.net</td>
                                    <td>United States</td>
                                    <td>Houston</td>
                                    <td>17325</td>
                                    <td>2012/11/27</td>
                                    <td>$198,500</td>
                                </tr>
                                <tr>
                                    <td>17</td>
                                    <td>238907</td>
                                    <td>Paul Byrd</td>
                                    <td>Chief Financial Officer (CFO)</td>
                                    <td>New York</td>
                                    <td>64</td>
                                    <td>(670) 725-7353</td>
                                    <td>wayward@mac.com</td>
                                    <td>Japan</td>
                                    <td>Tokyo</td>
                                    <td>45103</td>
                                    <td>2010/06/09</td>
                                    <td>$725,000</td>
                                </tr>
                                <tr>
                                    <td>18</td>
                                    <td>138997</td>
                                    <td>Gloria Little</td>
                                    <td>Systems Administrator</td>
                                    <td>New York</td>
                                    <td>59</td>
                                    <td>(993) 918-6493</td>
                                    <td>dogdude@gmail.com</td>
                                    <td>Kazakhstan</td>
                                    <td>Astana</td>
                                    <td>01915</td>
                                    <td>2009/04/10</td>
                                    <td>$237,500</td>
                                </tr>
                                <tr>
                                    <td>19</td>
                                    <td>930997</td>
                                    <td>Bradley Greer</td>
                                    <td>Software Engineer</td>
                                    <td>London</td>
                                    <td>41</td>
                                    <td>(454) 354-0847</td>
                                    <td>ahuillet@gmail.com</td>
                                    <td>Argentina</td>
                                    <td>Rosario</td>
                                    <td>31313</td>
                                    <td>2012/10/13</td>
                                    <td>$132,000</td>
                                </tr>
                                <tr>
                                    <td>20</td>
                                    <td>230987</td>
                                    <td>Dai Rios</td>
                                    <td>Personnel Lead</td>
                                    <td>Edinburgh</td>
                                    <td>35</td>
                                    <td>Phone</td>
                                    <td>Email</td>
                                    <td>Venezuela</td>
                                    <td>Maracaibo</td>
                                    <td>ZIP</td>
                                    <td>2012/09/26</td>
                                    <td>$217,500</td>
                                </tr>
                                <tr>
                                    <td>21</td>
                                    <td>550987</td>
                                    <td>Jenette Caldwell</td>
                                    <td>Development Lead</td>
                                    <td>New York</td>
                                    <td>30</td>
                                    <td>(315) 201-7941</td>
                                    <td>tristan@optonline.net</td>
                                    <td>China</td>
                                    <td>Tangshan</td>
                                    <td>37876</td>
                                    <td>2011/09/03</td>
                                    <td>$345,000</td>
                                </tr>
                                <tr>
                                    <td>22</td>
                                    <td>510987</td>
                                    <td>Yuri Berry</td>
                                    <td>Chief Marketing Officer (CMO)</td>
                                    <td>New York</td>
                                    <td>40</td>
                                    <td>(822) 760-3498</td>
                                    <td>bjoern@aol.com</td>
                                    <td>Colombia</td>
                                    <td>Cali</td>
                                    <td>70001</td>
                                    <td>2009/06/25</td>
                                    <td>$675,000</td>
                                </tr>
                                <tr>
                                    <td>23</td>
                                    <td>210987</td>
                                    <td>Caesar Vance</td>
                                    <td>Pre-Sales Support</td>
                                    <td>New York</td>
                                    <td>21</td>
                                    <td>(272) 803-9660</td>
                                    <td>webinc@live.com</td>
                                    <td>Nepal</td>
                                    <td>Kathmandu</td>
                                    <td>20747</td>
                                    <td>2011/12/12</td>
                                    <td>$106,450</td>
                                </tr>
                                <tr>
                                    <td>24</td>
                                    <td>714987</td>
                                    <td>Doris Wilder</td>
                                    <td>Sales Assistant</td>
                                    <td>Sydney</td>
                                    <td>23</td>
                                    <td>(834) 783-0240</td>
                                    <td>seano@yahoo.ca</td>
                                    <td>China</td>
                                    <td>Ningbo</td>
                                    <td>37601</td>
                                    <td>2010/09/20</td>
                                    <td>$85,600</td>
                                </tr>
                                <tr>
                                    <td>25</td>
                                    <td>915987</td>
                                    <td>Angelica Ramos</td>
                                    <td>Chief Executive Officer (CEO)</td>
                                    <td>London</td>
                                    <td>47</td>
                                    <td>(579) 389-3805</td>
                                    <td>onestab@verizon.net</td>
                                    <td>North</td>
                                    <td>Pyongyang</td>
                                    <td>01824</td>
                                    <td>2009/10/09</td>
                                    <td>$1,200,000</td>
                                </tr>
                                <tr>
                                    <td>26</td>
                                    <td>015987</td>
                                    <td>Gavin Joyce</td>
                                    <td>Developer</td>
                                    <td>Edinburgh</td>
                                    <td>42</td>
                                    <td>(734) 340-8380</td>
                                    <td>pereinar@gmail.com</td>
                                    <td>Poland</td>
                                    <td>Warsaw</td>
                                    <td>11542</td>
                                    <td>2010/12/22</td>
                                    <td>$92,575</td>
                                </tr>
                                <tr>
                                    <td>27</td>
                                    <td>015347</td>
                                    <td>Jennifer Chang</td>
                                    <td>Regional Director</td>
                                    <td>Singapore</td>
                                    <td>28</td>
                                    <td>(464) 405-0004</td>
                                    <td>itstatus@optonline.net</td>
                                    <td>Russia</td>
                                    <td>Rostov-on-Don</td>
                                    <td>07103</td>
                                    <td>2010/11/14</td>
                                    <td>$357,650</td>
                                </tr>
                                <tr>
                                    <td>28</td>
                                    <td>715347</td>
                                    <td>Brenden Wagner</td>
                                    <td>Software Engineer</td>
                                    <td>San Francisco</td>
                                    <td>28</td>
                                    <td>(711) 492-7591</td>
                                    <td>djpig@sbcglobal.net</td>
                                    <td>China</td>
                                    <td>Shijiazhuang</td>
                                    <td>34135</td>
                                    <td>2011/06/07</td>
                                    <td>$206,850</td>
                                </tr>
                                <tr>
                                    <td>29</td>
                                    <td>956347</td>
                                    <td>Fiona Green</td>
                                    <td>Chief Operating Officer (COO)</td>
                                    <td>San Francisco</td>
                                    <td>48</td>
                                    <td>(679) 345-7980</td>
                                    <td>geoffr@gmail.com</td>
                                    <td>China</td>
                                    <td>Fuzhou</td>
                                    <td>44145</td>
                                    <td>2010/03/11</td>
                                    <td>$850,000</td>
                                </tr>
                                <tr>
                                    <td>30</td>
                                    <td>236347</td>
                                    <td>Shou Itou</td>
                                    <td>Regional Marketing</td>
                                    <td>Tokyo</td>
                                    <td>20</td>
                                    <td>(438) 365-3710</td>
                                    <td>ducasse@icloud.com</td>
                                    <td>Brazil</td>
                                    <td>Curitiba</td>
                                    <td>45601</td>
                                    <td>2011/08/14</td>
                                    <td>$163,000</td>
                                </tr>
                                <tr>
                                    <td>31</td>
                                    <td>289347</td>
                                    <td>Michelle House</td>
                                    <td>Integration Specialist</td>
                                    <td>Sydney</td>
                                    <td>37</td>
                                    <td>(591) 400-1024</td>
                                    <td>ralamosm@optonline.net</td>
                                    <td>China</td>
                                    <td>Beijing</td>
                                    <td>37040</td>
                                    <td>2011/06/02</td>
                                    <td>$95,400</td>
                                </tr>
                                <tr>
                                    <td>32</td>
                                    <td>289325</td>
                                    <td>Suki Burks</td>
                                    <td>Developer</td>
                                    <td>London</td>
                                    <td>53</td>
                                    <td>(567) 463-8817</td>
                                    <td>emcleod@me.com</td>
                                    <td>Japan</td>
                                    <td>Kawasaki</td>
                                    <td>29464</td>
                                    <td>2009/10/22</td>
                                    <td>$114,500</td>
                                </tr>
                                <tr>
                                    <td>33</td>
                                    <td>989321</td>
                                    <td>Prescott Bartlett</td>
                                    <td>Technical Author</td>
                                    <td>London</td>
                                    <td>27</td>
                                    <td>(441) 446-7776</td>
                                    <td>mbalazin@msn.com</td>
                                    <td>Pakistan</td>
                                    <td>Islamabad</td>
                                    <td>53154</td>
                                    <td>2011/05/07</td>
                                    <td>$145,000</td>
                                </tr>
                                <tr>
                                    <td>34</td>
                                    <td>189329</td>
                                    <td>Gavin Cortez</td>
                                    <td>Team Leader</td>
                                    <td>San Francisco</td>
                                    <td>22</td>
                                    <td>(203) 380-1828</td>
                                    <td>hermes@me.com</td>
                                    <td>India</td>
                                    <td>Patna</td>
                                    <td>29461</td>
                                    <td>2008/10/26</td>
                                    <td>$235,500</td>
                                </tr>
                                <tr>
                                    <td>35</td>
                                    <td>109319</td>
                                    <td>Martena Mccray</td>
                                    <td>Post-Sales support</td>
                                    <td>Edinburgh</td>
                                    <td>46</td>
                                    <td>(696) 980-9216</td>
                                    <td>pkilab@hotmail.com</td>
                                    <td>Czech</td>
                                    <td>Prague</td>
                                    <td>33435</td>
                                    <td>2011/03/09</td>
                                    <td>$324,050</td>
                                </tr>
                                <tr>
                                    <td>36</td>
                                    <td>079319</td>
                                    <td>Unity Butler</td>
                                    <td>Marketing Designer</td>
                                    <td>San Francisco</td>
                                    <td>47</td>
                                    <td>(279) 733-7394</td>
                                    <td>jtorkbob@att.net</td>
                                    <td>Kenya</td>
                                    <td>Nairobi</td>
                                    <td>60110</td>
                                    <td>2009/12/09</td>
                                    <td>$85,675</td>
                                </tr>
                                <tr>
                                    <td>37</td>
                                    <td>076719</td>
                                    <td>Howard Hatfield</td>
                                    <td>Office Manager</td>
                                    <td>San Francisco</td>
                                    <td>51</td>
                                    <td>(627) 281-1043</td>
                                    <td>kudra@sbcglobal.net</td>
                                    <td>China</td>
                                    <td>Tangshan</td>
                                    <td>23451</td>
                                    <td>2008/12/16</td>
                                    <td>$164,500</td>
                                </tr>
                                <tr>
                                    <td>38</td>
                                    <td>976717</td>
                                    <td>Hope Fuentes</td>
                                    <td>Secretary</td>
                                    <td>San Francisco</td>
                                    <td>41</td>
                                    <td>(807) 555-6844</td>
                                    <td>kiddailey@live.com</td>
                                    <td>China</td>
                                    <td>Ningbo</td>
                                    <td>19380</td>
                                    <td>2010/02/12</td>
                                    <td>$109,850</td>
                                </tr>
                                <tr>
                                    <td>39</td>
                                    <td>576710</td>
                                    <td>Vivian Harrell</td>
                                    <td>Financial Controller</td>
                                    <td>San Francisco</td>
                                    <td>62</td>
                                    <td>(849) 915-8607</td>
                                    <td>sokol@optonline.net</td>
                                    <td>Japan</td>
                                    <td>Nagoya</td>
                                    <td>91740</td>
                                    <td>2009/02/14</td>
                                    <td>$452,500</td>
                                </tr>
                                <tr>
                                    <td>40</td>
                                    <td>976710</td>
                                    <td>Timothy Mooney</td>
                                    <td>Office Manager</td>
                                    <td>London</td>
                                    <td>37</td>
                                    <td>(654) 850-4131</td>
                                    <td>arandal@sbcglobal.net</td>
                                    <td>India</td>
                                    <td>Nagpur</td>
                                    <td>22304</td>
                                    <td>2008/12/11</td>
                                    <td>$136,200</td>
                                </tr>
                                <tr>
                                    <td>41</td>
                                    <td>776711</td>
                                    <td>Jackson Bradshaw</td>
                                    <td>Director</td>
                                    <td>New York</td>
                                    <td>65</td>
                                    <td>(619) 270-0357</td>
                                    <td>aschmitz@me.com</td>
                                    <td>China</td>
                                    <td>Shantou</td>
                                    <td>33404</td>
                                    <td>2008/09/26</td>
                                    <td>$645,750</td>
                                </tr>
                                <tr>
                                    <td>42</td>
                                    <td>976011</td>
                                    <td>Olivia Liang</td>
                                    <td>Support Engineer</td>
                                    <td>Singapore</td>
                                    <td>64</td>
                                    <td>(586) 863-8230</td>
                                    <td>bhima@yahoo.com</td>
                                    <td>China</td>
                                    <td>Shantou</td>
                                    <td>02472</td>
                                    <td>2011/02/03</td>
                                    <td>$234,500</td>
                                </tr>
                                <tr>
                                    <td>43</td>
                                    <td>375018</td>
                                    <td>Bruno Nash</td>
                                    <td>Software Engineer</td>
                                    <td>London</td>
                                    <td>38</td>
                                    <td>(305) 379-4116</td>
                                    <td>formis@icloud.com</td>
                                    <td>United States</td>
                                    <td>San Antonio</td>
                                    <td>35758</td>
                                    <td>2011/05/03</td>
                                    <td>$163,500</td>
                                </tr>
                                <tr>
                                    <td>44</td>
                                    <td>274011</td>
                                    <td>Sakura Yamamoto</td>
                                    <td>Support Engineer</td>
                                    <td>Tokyo</td>
                                    <td>37</td>
                                    <td>(686) 789-2798</td>
                                    <td>lahvak@aol.com</td>
                                    <td>United States</td>
                                    <td>Los Angeles</td>
                                    <td>60201</td>
                                    <td>2009/08/19</td>
                                    <td>$139,575</td>
                                </tr>
                                <tr>
                                    <td>45</td>
                                    <td>674061</td>
                                    <td>Thor Walton</td>
                                    <td>Developer</td>
                                    <td>New York</td>
                                    <td>61</td>
                                    <td>(555) 724-1911</td>
                                    <td>willg@verizon.net</td>
                                    <td>Mexico</td>
                                    <td>Guadalajara</td>
                                    <td>18966</td>
                                    <td>2013/08/11</td>
                                    <td>$98,540</td>
                                </tr>
                                <tr>
                                    <td>46</td>
                                    <td>874068</td>
                                    <td>Finn Camacho</td>
                                    <td>Support Engineer</td>
                                    <td>San Francisco</td>
                                    <td>47</td>
                                    <td>(596) 984-7396</td>
                                    <td>inico@att.net</td>
                                    <td>Australia</td>
                                    <td>Brisbane</td>
                                    <td>49509</td>
                                    <td>2009/07/07</td>
                                    <td>$87,500</td>
                                </tr>
                                <tr>
                                    <td>47</td>
                                    <td>854098</td>
                                    <td>Serge Baldwin</td>
                                    <td>Data Coordinator</td>
                                    <td>Singapore</td>
                                    <td>64</td>
                                    <td>(671) 343-3218</td>
                                    <td>tmaek@verizon.net</td>
                                    <td>Pakistan</td>
                                    <td>Hyderabad</td>
                                    <td>43081</td>
                                    <td>2012/04/09</td>
                                    <td>$138,575</td>
                                </tr>
                                <tr>
                                    <td>48</td>
                                    <td>854012</td>
                                    <td>Zenaida Frank</td>
                                    <td>Software Engineer</td>
                                    <td>New York</td>
                                    <td>63</td>
                                    <td>(731) 315-0550</td>
                                    <td>pplinux@optonline.net</td>
                                    <td>Mexico</td>
                                    <td>Monterrey</td>
                                    <td>19380</td>
                                    <td>2010/01/04</td>
                                    <td>$125,250</td>
                                </tr>
                                <tr>
                                    <td>49</td>
                                    <td>124089</td>
                                    <td>Zorita Serrano</td>
                                    <td>Software Engineer</td>
                                    <td>San Francisco</td>
                                    <td>56</td>
                                    <td>(916) 505-5139</td>
                                    <td>twoflower@gmail.com</td>
                                    <td>Pakistan</td>
                                    <td>Rawalpindi</td>
                                    <td>30096</td>
                                    <td>2012/06/01</td>
                                    <td>$115,000</td>
                                </tr>
                                <tr>
                                    <td>50</td>
                                    <td>924089</td>
                                    <td>Jennifer Acosta</td>
                                    <td>Junior Javascript Developer</td>
                                    <td>Edinburgh</td>
                                    <td>43</td>
                                    <td>(687) 248-1187</td>
                                    <td>tokuhirom@icloud.com</td>
                                    <td>Brazil</td>
                                    <td>Brasília</td>
                                    <td>60459</td>
                                    <td>2013/02/01</td>
                                    <td>$75,650</td>
                                </tr>
                                <tr>
                                    <td>51</td>
                                    <td>123099</td>
                                    <td>Cara Stevens</td>
                                    <td>Sales Assistant</td>
                                    <td>New York</td>
                                    <td>46</td>
                                    <td>(406) 721-7663</td>
                                    <td>fraser@optonline.net</td>
                                    <td>Egypt</td>
                                    <td>Cairo</td>
                                    <td>43420</td>
                                    <td>2011/12/06</td>
                                    <td>$145,600</td>
                                </tr>
                                <tr>
                                    <td>52</td>
                                    <td>723399</td>
                                    <td>Hermione Butler</td>
                                    <td>Regional Director</td>
                                    <td>London</td>
                                    <td>47</td>
                                    <td>(483) 653-8676</td>
                                    <td>skajan@yahoo.com</td>
                                    <td>Chile</td>
                                    <td>Santiago</td>
                                    <td>22041</td>
                                    <td>2011/03/21</td>
                                    <td>$356,250</td>
                                </tr>
                                <tr>
                                    <td>53</td>
                                    <td>323399</td>
                                    <td>Lael Greer</td>
                                    <td>Systems Administrator</td>
                                    <td>London</td>
                                    <td>21</td>
                                    <td>(818) 784-2525</td>
                                    <td>mcsporran@aol.com</td>
                                    <td>India</td>
                                    <td>Chennai</td>
                                    <td>30240</td>
                                    <td>2009/02/27</td>
                                    <td>$103,500</td>
                                </tr>
                                <tr>
                                    <td>54</td>
                                    <td>783129</td>
                                    <td>Jonas Alexander</td>
                                    <td>Developer</td>
                                    <td>San Francisco</td>
                                    <td>30</td>
                                    <td>(515) 806-7053</td>
                                    <td>geekgrl@optonline.net</td>
                                    <td>Uruguay</td>
                                    <td>Montevideo</td>
                                    <td>20147</td>
                                    <td>2010/07/14</td>
                                    <td>$86,500</td>
                                </tr>
                                <tr>
                                    <td>55</td>
                                    <td>756129</td>
                                    <td>Shad Decker</td>
                                    <td>Regional Director</td>
                                    <td>Edinburgh</td>
                                    <td>51</td>
                                    <td>(253) 238-3581</td>
                                    <td>jbearp@sbcglobal.net</td>
                                    <td>China</td>
                                    <td>Shenzhen</td>
                                    <td>44060</td>
                                    <td>2008/11/13</td>
                                    <td>$183,000</td>
                                </tr>
                                <tr>
                                    <td>56</td>
                                    <td>056229</td>
                                    <td>Michael Bruce</td>
                                    <td>Javascript Developer</td>
                                    <td>Singapore</td>
                                    <td>29</td>
                                    <td>(713) 941-8848</td>
                                    <td>marioph@verizon.net</td>
                                    <td>Iraq</td>
                                    <td>Basra</td>
                                    <td>46804</td>
                                    <td>2011/06/27</td>
                                    <td>$183,000</td>
                                </tr>
                                <tr>
                                    <td>57</td>
                                    <td>996229</td>
                                    <td>Donna Snider</td>
                                    <td>Customer Support</td>
                                    <td>New York</td>
                                    <td>27</td>
                                    <td>(272) 760-6426</td>
                                    <td>mgreen@verizon.net</td>
                                    <td>China</td>
                                    <td>Fuzhou</td>
                                    <td>18966</td>
                                    <td>2011/01/25</td>
                                    <td>$112,000</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Card ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>ZIP</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- END Datatable -->
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#datatable-1").DataTable({
            scrollCollapse: true,
            scrollY: "50vh",
            scrollX: true
        });
        $(".input-daterange").datepicker({
            todayHighlight: true
        });
    });
    $("#simpaninformasidasar").on("click", function () {
  
    });
</script>
<?= $this->endSection(); ?>