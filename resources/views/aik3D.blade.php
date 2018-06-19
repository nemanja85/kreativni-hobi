<!DOCTYPE html>
<html>
      <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
            <title>AIK Secure Payment Page</title>
            <link type="text/css" rel="stylesheet" href="style.css"/>
            <script type="text/javascript">

            function centerit(){
            	var x=document.getElementById('container').offsetHeight;
            	var y=526;
            	var z=(x-y)/2;
            	document.getElementById('container').style.marginTop=''+z+'px';

            }
            </script>
      </head>
      <body>
            <div id="wrapper">

                  <div class="header">
                        <span>
                              <img src="est3dimages/aik/kh-logo.svg"/>
                        </span>
                  </div>
                  <div id="container">
                        <div class="logo1">
                              <span>AIK</span>
                        </div>
                        <div id="page">
                              <div class="info">
                                    <form id="login" action="/fim/est3dgate" method="post" name="logoform" autocomplete="off">
                                          <input type="hidden" name="xid" value="n7n9IpNzpcD1+IXqdvYVldb3esY="/>
                                          <input type="hidden" name="clientid" value="510030000"/>
                                          <input type="hidden" name="amount" value="1500.00"/>
                                          <input type="hidden" name="trantype" value="Auth"/>
                                          <input type="hidden" name="instalment" value=""/>
                                          <input type="hidden" name="oid" value="668"/>
                                          <input type="hidden" name="okUrl" value="http://razmena.co.rs/notola/srbijatel/checkout/order-recived/668?key=wc_order_59a7d9cad8a57"/>
                                          <input type="hidden" name="failUrl" value="http://razmena.co.rs/notola/srbijatel/checkout/наруџба-за-плаћање/668?key=wc_order_59a7d9cad8a57"/>
                                          <input type="hidden" name="rnd" value="123456789"/>
                                          <input type="hidden" name="hash" value="ADtUc5PYUmZvbFOpuNGTekHevQw="/>
                                          <input type="hidden" name="storetype" value="3D_PAY_HOSTING"/>
                                          <input type="hidden" name="lang" value="en"/>
                                          <input type="hidden" name="currency" value="941"/>
                                          <input type="hidden" name="refreshtime" value="3"/>
                                          <input type="hidden" name="BillToName" value="NenadLabudovic"/>
                                          <input type="hidden" name="BillToStreet1" value="Milana 9"/>
                                          <input type="hidden" name="BillToStreet2" value=""/>
                                          <input type="hidden" name="BillToCity" value="Beograd"/>
                                          <input type="hidden" name="BillToStateProv" value="Srbija"/>
                                          <input type="hidden" name="BillToCountry" value="RS"/>
                                          <input type="hidden" name="BillToPostalCode" value="11000"/>
                                          <input type="hidden" name="email" value="nenad.labudovic@bglighthouse.com"/>
                                          <input type="hidden" name="tel" value="3333333333"/>
                                          <table width="100%" cellpadding="5" cellspacing="0">
                                                <tbody>
                                                      <tr>
                                                            <td align="left" valign="top" width="200">
                                                                  <span class="text">Merchant Name:</span>
                                                            </td>
                                                            <td align="left" valign="top">
                                                                  <span class="text">3D PAY HOSTING MODEL</span>
                                                            </td>
                                                      </tr>
                                                      <tr>
                                                            <td align="left" valign="top" width="200">
                                                                  <span class="text">Card Number:</span>
                                                            </td>
                                                            <td align="left" valign="top">
                                                                  <input type="text" size="20" name="pan" maxlength="19" autocomplete="off"/>
                                                            </td>
                                                      </tr>
                                                      <tr>
                                                            <td align="left" valign="top" width="200">
                                                                  <span class="text">Expiration date:</span>
                                                            </td>
                                                            <td align="left" valign="top">
                                                                  <select name="Ecom_Payment_Card_ExpDate_Month">
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                        <option value="03">03</option>
                                                                        <option value="04">04</option>
                                                                        <option value="05">05</option>
                                                                        <option value="06">06</option>
                                                                        <option value="07">07</option>
                                                                        <option value="08">08</option>
                                                                        <option value="09">09</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                  </select>
                                                                  &nbsp;&nbsp;&nbsp;
                                                                  <select name="Ecom_Payment_Card_ExpDate_Year">
                                                                        <option value="17">2017</option>
                                                                        <option value="18">2018</option>
                                                                        <option value="19">2019</option>
                                                                        <option value="20">2020</option>
                                                                        <option value="21">2021</option>
                                                                        <option value="22">2022</option>
                                                                        <option value="23">2023</option>
                                                                        <option value="24">2024</option>
                                                                        <option value="25">2025</option>
                                                                        <option value="26">2026</option>
                                                                        <option value="27">2027</option>
                                                                        <option value="28">2028</option>
                                                                        <option value="29">2029</option>
                                                                        <option value="30">2030</option>
                                                                        <option value="31">2031</option>
                                                                        <option value="32">2032</option>
                                                                        <option value="33">2033</option>
                                                                        <option value="34">2034</option>
                                                                        <option value="35">2035</option>
                                                                        <option value="36">2036</option>
                                                                        @@years@@
                                                                  </select>
                                                            </td>
                                                      </tr>
                                                      <tr>
                                                            <td align="left" valign="top" width="200">
                                                                  <span class="text">CVC2 / CVV2 Number:</span>
                                                                  <br/>
                                                                  <span class="textsmall">Last 3 digit number following your credit card number</span>
                                                            </td>
                                                            <td align="left" valign="top">
                                                                  <input type="text" size="4" name="cv2" maxlength="4" autocomplete="off"/>
                                                            </td>
                                                      </tr>
                                                      <tr>
                                                            <td align="left" valign="top" width="200">
                                                                  <span class="text">Installment Number:</span>
                                                            </td>
                                                            <td align="left" valign="top">
                                                                  <span class="text">No Installment</span>
                                                            </td>
                                                      </tr>
                                                      <tr>
                                                            <td align="left" valign="top" width="200">
                                                                  <span class="text">Total:</span>
                                                            </td>
                                                            <td align="left" valign="top">
                                                                  <span class="text">1500.00 RSD</span>
                                                            </td>
                                                      </tr>
                                                </tbody>
                                          </table>
                                    </form>
                              </div>
                        </div>
                        <!--
                              END PAGE
                        -->
                        <div class="footer">
                              <div class="inside">
                                    <table class="client-data">
                                          <tbody>
                                                <tr>
                                                      <td>
                                                            <img src="est3dimages/aik/sigla1.gif" alt=""/>
                                                      </td>
                                                      <td>
                                                            <input type="submiit" class="button" onclick="this.disabled=true;this.value='Sumnitting...'; this.form.submit();" value="PAY NOW" id="btnSbmt"/>
                                                      </td>
                                                      <td>
                                                            <img src="est3dimages/aik/sigla2.gif" alt=""/>
                                                      </td>
                                                </tr>
                                          </tbody>
                                    </table>
                              </div>
                        </div>
                        <!-- <div class="logo2"><span>AIK</span></div> -->
                  </div>
            </div>
      </body>
</html>
