<?php

  /*
  ------------------------------------------------------------------------------
  
  Title       :     email()
  Version     :     0.9.2
  Author      :     Jason Jacques <jtjacques@users.sourceforge.net>
  URL         :     http://poss.sourceforge.net/email
  
  Description :     PHP mail() clone with build in MTA
                    Returns TRUE or FALSE depending on delivery status.

  Usage       :     email(to, subject, message [, headers [, parameters]])
                    Set $ev_verbose = TRUE in your PHP script for verbose error
                    output. See documentation for more details.
                      
  Copyright   :     2005, 2006 Jason Jacques
  License     :     MIT License
  
  Created     :     15/06/2005
  Modified    :     07/02/2006
  
  Key Updates :     * Changed to MIT License
  
                    + Fixed default DNS
                    + Removed requirement for internal str_pad() function
                    + Fixed faulty assumption of RFC 822 in address parsing
                    + Added header cleaning to prevent headers showing in
                      message
                    + Added chunk_split() as alternitive to wordwrap()
                    + Prevented time-out occuring due to DNS error
                    + Added X-Mailer: header
                    + Added Date: header
                    
                    + Fixed errors in Updates & Updated Email Address
                    
  Todo        :     - Create wordwrap() function to improve format checking on
                      PHP <= 4.0.2 installations.
                    - Investigate and impliment other applicable
                      "additional_parameters".
                    
  Notes       :     The default DNS server is 4.2.2.1 provided by Verizon via
                    Level 3 Communications, Inc. for the purpouse of testing
                    email() it is suggested that the default DNS is changed to
                    your DNS server if this script is to be utilised in a
                    production environment for both performance and [potential]
                    legal reasons.
  
  ------------------------------------------------------------------------------
  */
  
  // Set email() version
  
  $ev_version = "0.9.1";

  // Check functions have not been created before.
  if(!function_exists("email"))
  {
    
    // Main function - see documentation for useage details
    function email($to, $subject, $message, $headers="", $parameters="")
    {
      // Initialise variables to 0
      $user_no = 0; $ret_error = 0;
      
      // Import global variables
      global $ev_verbose;
      
      // Decode formatted user and sender data
      $sender  = esf_decode_param($parameters);
      $user    = esf_decode_to($to);
      
      // Clean up message data, prevent header injection
      $msg     = esf_clean_msg($message);
      $subject = esf_clean_subject($subject);
      
      // Create final message, RFC2822 complient
      $header  = esf_create_header($to, $sender, $subject, $headers);
      $msg     = esf_create_msg($header, $msg);
      
      // Send message to each user identified
      while(@$user[$user_no]['address'] != NULL)
      {
        // Send message, check return code for errors
        $errors[$user_no] = esf_send_msg($user[$user_no], $sender, $msg);
        
        // Check error 
        if($errors[$user_no] > 0)
          $ret_error++;
          
        // Advance to next recipient
        $user_no++;
      }
      
      if($ev_verbose === TRUE)
        esf_verbose($user, $errors);
      
      if($ret_error == 0)
        return TRUE;
      
      //return $errors; 
      return FALSE;
    }
    
    // email() support functions (esf_)

    // Decode parametes (get 'sendmail' envelope sender)
    function esf_decode_param($params)
    {
      // Import global variables
      global $HTTP_SERVER_VARS;
      
      // Check for 'sendmail' envelope sender option (-f) and extract address
      if(strpos($params, "-f") === TRUE)
      {
        $sender = substr($params, (strpos($params, "-f")+2),
                                (strpos($params, "-f") + strpos($params, " ")));
      }
      else
      {
        $sender = "feedback@" . $HTTP_SERVER_VARS['SERVER_NAME'];
      }
      
      return $sender;
    }
    
    // Seperate individual 'to' addresses
    function esf_decode_to($to)
    {
      // Initialise variables to 0
      $user_no = 0;

      // Sepeate 'to' user strings
      $to = explode(",", $to);
      
      while(@$to[$user_no] != NULL)
      {
        // Strip white space begining and end
        $to[$user_no] = trim($to[$user_no]);
        
        // Check if contains plain text name (and address in angled brackets)
        if(strpos($to[$user_no], "<") === FALSE)
        {
          // Assume email address
          $users[$user_no]['address'] = $to[$user_no];
        }
        else
        {
          // Seperate plain text name and email address
          $users[$user_no]['name']    =
                  trim(substr($to[$user_no], 0, strpos($to[$user_no], "<")));
          $users[$user_no]['address'] =
                  trim(substr($to[$user_no], strpos($to[$user_no], "<")+1, -1));
        }
        
        // Advance to next address
        $user_no++;
      }
      
      return $users;
    }
    
    // Clean up message in preperation to be sent
    function esf_clean_msg($msg)
    {
      // Convert '\r\n' into '\n' (prevent '\r\n.\r\n' error) and wordwrap
      $msg = str_replace("\r\n", "\n", $msg);
      if(function_exists("wordwrap"))
      {
        // Comply with reccomendations
        $msg = wordwrap($msg, 70, "\n");
      }
      else
      {
        // Prevent breach
        $msg = chunk_split($msg, 990, "\n");
      }
      
      return $msg;
    }
    
    // Clean up subject line (*Security related*)
    function esf_clean_subject($subject)
    {
      // Strip out '\r' and '\n' to prevent header injection
      $subject = str_replace("\r", "", str_replace("\n", "", $subject));
      
      return $subject;
    }
    
    // Create a RFC2822 complient header
    function esf_create_header($to, $sender, $subject, $header)
    {
      // Import global variables
      global $HTTP_SERVER_VARS; global $ev_version;
      
      // Clean user defined headers
      $header = trim($header);
      
      // Add 'X-Mailer:' header if missing
      if(strpos($header, "X-Mailer:") === FALSE)
        $header = "X-Mailer: POSS email() v " . $ev_version . " from " . 
                          $HTTP_SERVER_VARS['SERVER_NAME'] . "\r\n" . $header;
      
      // Add 'Subject:' header if missing
      if(strpos($header, "Subject:") === FALSE)
        $header = "Subject: " . $subject . "\r\n" . $header; 
      
      // Add 'From:' header if missing
      if(strpos($header, "From:") === FALSE)
        $header = "From: " . $sender . "\r\n" . $header;
      
      // Add 'To:' header if missing
      if(strpos($header, "To:") === FALSE)
        $header = "To: " . $to . "\r\n" . $header;
      
      // Add 'Date:' header if missing
      if(strpos($header, "Date:") === FALSE)
        $header = "Date: " . date("D, d M Y H:i:s O") . "\r\n" . $header;
        
      // Trim and finish header
      $header = trim($header) . "\r\n\r\n";     
      
      return $header;
    }
    
    // Create final RFC2822 compliant message
    function esf_create_msg($headers, $msg)
    {
      // Attach header to message and finalise
      $msg = $headers . $msg . "\r\n.\r\n";
      
      return $msg;
    }
    
    function esf_send_msg($to, $from, $msg)
    {
      // Initialise variables to 0
      $errors = 0;

      // Import global variables
      global $HTTP_SERVER_VARS;
      
      // Open socket connection to SMTP server
      @$rcv_server = fsockopen(esf_mxlookup($to['address']), 25,
                                                  $null, $null2, 5);
                                                        
      if(@$rcv_server)
      {
        socket_set_timeout($rcv_server, 5);
        
        // Handshake connection and prepare for message delivery
        $errors += (esf_read_response($rcv_server) * 1);
        fwrite($rcv_server, "HELO " . $HTTP_SERVER_VARS['SERVER_NAME']. "\r\n");
        $errors += (esf_read_response($rcv_server) * 2);
        fwrite($rcv_server, "MAIL FROM:<" . $from . ">\r\n");
        $errors += (esf_read_response($rcv_server) * 4);
        fwrite($rcv_server, "RCPT TO:<" . $to['address'] . ">\r\n");
        $errors += (esf_read_response($rcv_server) * 8);
        fwrite($rcv_server, "DATA\r\n");
        $errors += (esf_read_response($rcv_server) * 16);
        
        // Send message data
        fwrite($rcv_server, $msg);
        $errors += (esf_read_response($rcv_server) * 32);
        
        // Close connection
        fwrite($rcv_server, "QUIT\r\n");
        $errors += (esf_read_response($rcv_server) * 64);
        fclose($rcv_server);
      }
      else
      {
        // On connection error set all to 'Failed'
        return 127;
      }
      
      return $errors;
    }
    
    // Read response to data/command sent
    function esf_read_response($buffer)
    {
      // Get response code from the stream buffer
      $response_code = fgets($buffer);
      
      // If code's first digit is 4 or greater, and error has occured
      if((substr($response_code, 0, 1) > 3) || ($response_code == NULL))
        return 1;
      
      // Otherwise no error occured
      return 0;
    }
    
    // Give verbose output as to functions success
    function esf_verbose($address, $error)
    {
      // Initialise variables to 0
      $user_no = 0;
      
      // Write title
      echo "\r\n<p><strong>email() verbose output</strong><p>\r\n";
      
      while(@$address[$user_no]['address'] !== NULL)
      {
        // Write user email referance
        echo "<strong>User " . $user_no . " (" . $address[$user_no]['address']
                                                        . ")</strong><br>\r\n";
        
        // Convert string to sequencial 1 (error) & 0 (pass) string
        $binary = strrev(decbin($error[$user_no]));
        $binary = $binary . substr("00000000",0,8 - strlen($binary));
        
        // List results
        echo "Connect to " . esf_mxlookup($address[$user_no]['address']) . ": ";
        esf_verbose_check($binary, 0);
        echo "Sent 'HELO' command: ";
        esf_verbose_check($binary, 1);
        echo "Sent 'MAIL FROM:' command: ";
        esf_verbose_check($binary, 2);
        echo "Sent 'RCPT TO:' command: ";
        esf_verbose_check($binary, 3);
        echo "Sent 'DATA' command: ";
        esf_verbose_check($binary, 4);
        echo "Sent message content: ";
        esf_verbose_check($binary, 5);
        echo "Sent 'QUIT' command: ";
        esf_verbose_check($binary, 6);
        echo "&nbsp<br>\r\n";
        
        // Advance to next user
        $user_no++;
      }
      
      return 0;
    }
    
    // Echo status
    function esf_verbose_check($binary, $bit)
    {
        if($binary{$bit} == 1)
        {
          echo "<strong>Failed</strong><br>\r\n"; 
        }
        else
        {
          echo "Success<br>\r\n";
        }
        
        return 0;
    }
    
    // esf_send_msg support functions
    
    // Return one MX server address
    function esf_mxlookup($domain, $dns="4.2.2.1")
    {
      // Initialise variables
      $address_no = 0; $cur_priority=9999;
      
      // Strip user from email address if present
      if(strpos($domain, "@") !== FALSE)
        $domain = substr($domain, (strpos($domain, "@")+1));
      
      // Convert domain into RFC1035 complient DNS request
      $package = esf_mx_package_domain($domain);
      
      // Query DNS server
      $reply   = esf_mx_get_response($package, $dns);
      
      // Convert reply into address array
      $address  = esf_mx_decode_reply($reply);
      
      // Sort server with lowest priority
      while(@$address[$address_no]['address'] != NULL)
      {
        if($address[$address_no]['priority'] < $cur_priority)
        {
          $cur_priority = $address[$address_no]['priority'];
          $domain     = $address[$address_no]['address'];
        }
        
        // Advance to next address
        $address_no++;
      }
      
      return $domain;
    }
    
    // esf_mxlookup support functions (esf_mx_)
    
    // Convert domain into RFC1035 complient DNS request
    function esf_mx_package_domain($domain)
    {
      // Initialise variables to 0
      $part_no = 0; $question = NULL;
      
      // Create header see RFC1035 Section 4.1.1. for more information
      $header = chr(0) . chr(1) .
                chr(1) . chr(0) .
                chr(0) . chr(1) .
                chr(0) . chr(0) .
                chr(0) . chr(0) .
                chr(0) . chr(0) ;
      
      // Convert domain to RFC1035 message format
      $domain = explode(".", trim($domain));
      while(@$domain[$part_no] != NULL)
      {
        $question .= chr(strlen(trim($domain[$part_no])))
                                            . trim($domain[$part_no]);
        
        // Advance to next part
        $part_no++;
      }
      $question .= chr(0);
      
      // Set Question Type
      $qtype  = chr(0) . chr(15) .
                chr(0) . chr(1)  ;
      
      // Construct final packet
      $packet = $header . $question . $qtype;
      
      return $packet;
    }
    
    // Connect to and query DNS server
    function esf_mx_get_response($packet, $dns)
    {
      // Set type to UDP
      $dns = "udp://" . $dns;
      
      // Open connection to DNS server
      $dns_server = fsockopen($dns, 53);
      socket_set_timeout($dns_server, 10);
      
      // Send packet
      fwrite($dns_server, $packet);
      
      // Get 512 byte reply (maximum packet size over UDP connection)
      $reply = fread($dns_server, 512);
      
      // Close connection
      fclose($dns_server);
      
      return $reply;
    }
    
    // Decode DNS server reply - Refer to RFC1035 for explantaion
    function esf_mx_decode_reply($reply)
    {
      // Initialise variables
      $count = 0; $pointer = 16;
      
      // Read truncation bit
      $tc_bit = decbin(ord(substr($reply, 2, 1)));
      
      // Read question address
      $address[0] = esf_mx_read_domain($reply, 12);
      $pointer += $address[0]['bytes'];

      // Check number of answers
      $no_reply = ord(substr($reply, 7, 1));
      
      // If no mx server identified give domain benifit of doubt
      if($no_reply == 0)
      {
       $address[0]['priority'] = 0;
       
       return $address;
      }

      // Read replies into array
      while($count < $no_reply)
      {
        // Skip through abitary 'question' address
        $pointer_adv = esf_mx_read_domain($reply, $pointer);
        $pointer += $pointer_adv['bytes'] + 10; 
        
        // Read address and priority
        $address[$count] = esf_mx_read_domain($reply, $pointer+2);
        $address[$count]['priority'] = ord(substr($reply, $pointer+1, 1));
        $pointer += $address[$count]['bytes'] + 2;
        
        // If list truncated run with what we have!
        if($tc_bit{6} == 1)
          return $address;
        
        // Advance to next reply
        $count++;
      }
      
      return $address;
    }
    
    // Read domain from labels
    function esf_mx_read_domain($reply, $pointer)
    {
      // Initialise variables
      $domain['address'] = NULL; $domain['bytes'] = 0;
      
      // Reconsruct domain
      while(ord(substr($reply, $pointer, 1)) > 0)
      {
        // Check to see if data is compressed
        if(ord(substr($reply, $pointer, 1)) > 63)
        {
          $domain['address'] .= esf_mx_uncompress($reply, ord(substr($reply,
                                                              $pointer+1, 1)));
          $domain['bytes'] += 2;
          return $domain;
        }
        
        // If uncompressed read label
        $domain['address'] .= substr($reply, $pointer+1,
                                      ord(substr($reply, $pointer, 1))) . ".";
        $domain['bytes']  += ord(substr($reply, $pointer, 1)) + 1;
        $pointer          += ord(substr($reply, $pointer, 1)) + 1;
      }
      $domain['bytes'] += 1;
      
      return $domain;
    }
    
    // Uncompress data (reuse read_domain but strip array)
    function esf_mx_uncompress($reply, $pointer)
    {
      $address = esf_mx_read_domain($reply, $pointer);
      return $address['address'];
    }
  
  }
  

?>
