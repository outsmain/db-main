﻿USE nerepdb;

CREATE TABLE `NE_RUN_DATA` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `UPDATE_DATE` datetime NOT NULL,
  `IP_ADDR` varchar(64) NOT NULL,
  `NE_RUN_TYPE_ID` int(10) unsigned DEFAULT NULL,
  `DATA` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;


insert into `NE_RUN_DATA`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_TYPE_ID`,`DATA`) values (1,'2013-06-06 01:30:20','14.23.9.278',1,'*A:AUISJB2879# show router interface detail

===============================================================================
Interface Table (Router: Base)
===============================================================================
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : OSPFv2 PIM 
IP Addr/mask     : 14.23.9.278/24    Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 9                    Virt. If Index    : 9
Last Oper Chg    : 06/06/2011 00:35:50  Global If Index   : 384
SAP Id           : lag-12:2.23
TOS Marking      : Untrusted            If Type           : IES
SNTP B.Cast      : False                IES ID            : 524
MAC Address      : 04:03:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9190                 ICMP Mask Reply   : True
Arp Populate     : Disabled             Host Conn Verify  : Disabled
Cflowd           : None                 
LdpSyncTimer     : None                 
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

DHCP no local server

DHCP Details
Description      : Connect to A
Admin State      : Down                 Lease Populate    : 0
Gi-Addr          : 14.23.9.278*      Gi-Addr as Src Ip : Disabled 
* = inferred gi-address from interface IP address

Action           : Keep                 Trusted           : Disabled

DHCP Proxy Details
Admin State      : Down                 
Lease Time       : N/A                  
Emul. Server     : Not configured       

Subscriber Authentication Details
Auth Policy      : None                 

DHCP6 Relay Details
Description      : Connect to A
Admin State      : Down                 Lease Populate    : 0
Oper State       : Down                 Nbr Resolution    : Disabled
If-Id Option     : None                 Remote Id         : Disabled
Src Addr         : Not configured

DHCP6 Server Details
Admin State      : Down                 Max. Lease States : 8000

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : OSPFv2 PIM 
IP Addr/mask     : 14.23.9.278/24      Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 10                   Virt. If Index    : 10
Last Oper Chg    : 06/06/2011 00:35:50  Global If Index   : 383
SAP Id           : lag-12:2.23
TOS Marking      : Untrusted            If Type           : IES
SNTP B.Cast      : False                IES ID            : 529
MAC Address      : 04:03:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9190                 ICMP Mask Reply   : True
Arp Populate     : Disabled             Host Conn Verify  : Disabled
Cflowd           : None                 
LdpSyncTimer     : None                 
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

DHCP no local server

DHCP Details
Description      : Connect to A
Admin State      : Down                 Lease Populate    : 0
Gi-Addr          : 14.23.9.278*        Gi-Addr as Src Ip : Disabled 
* = inferred gi-address from interface IP address

Action           : Keep                 Trusted           : Disabled

DHCP Proxy Details
Admin State      : Down                 
Lease Time       : N/A                  
Emul. Server     : Not configured       

Subscriber Authentication Details
Auth Policy      : None                 

DHCP6 Relay Details
Description      : Connect to A
Admin State      : Down                 Lease Populate    : 0
Oper State       : Down                 Nbr Resolution    : Disabled
If-Id Option     : None                 Remote Id         : Disabled
Src Addr         : Not configured

DHCP6 Server Details
Admin State      : Down                 Max. Lease States : 8000

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : OSPFv2 PIM 
IP Addr/mask     : 14.23.9.278/24       Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 11                   Virt. If Index    : 11
Last Oper Chg    : 06/06/2011 00:35:50  Global If Index   : 382
SAP Id           : lag-12:2.23
TOS Marking      : Untrusted            If Type           : IES
SNTP B.Cast      : False                IES ID            : 596
MAC Address      : 04:03:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9190                 ICMP Mask Reply   : True
Arp Populate     : Disabled             Host Conn Verify  : Disabled
Cflowd           : None                 
LdpSyncTimer     : None                 
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

DHCP no local server

DHCP Details
Description      : Connect to A
Admin State      : Down                 Lease Populate    : 0
Gi-Addr          : 14.23.9.278*         Gi-Addr as Src Ip : Disabled 
* = inferred gi-address from interface IP address

Action           : Keep                 Trusted           : Disabled

DHCP Proxy Details
Admin State      : Down                 
Lease Time       : N/A                  
Emul. Server     : Not configured       

Subscriber Authentication Details
Auth Policy      : None                 

DHCP6 Relay Details
Description      : Connect to A
Admin State      : Down                 Lease Populate    : 0
Oper State       : Down                 Nbr Resolution    : Disabled
If-Id Option     : None                 Remote Id         : Disabled
Src Addr         : Not configured

DHCP6 Server Details
Admin State      : Down                 Max. Lease States : 8000

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : OSPFv2 MPLS RSVP PIM 
IP Addr/mask     : 14.23.9.278/32      Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 2                    Virt. If Index    : 2
Last Oper Chg    : 06/06/2011 00:34:59  Global If Index   : 128
Port Id          : loopback
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 1
Queue-group      : None                 
MAC Address      : 04:03:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 1500                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30    Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 20                   Virt. If Index    : 20
Last Oper Chg    : 06/06/2011 00:35:49  Global If Index   : 127
Port Id          : 1/1/4
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 04:4b:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30    Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 21                   Virt. If Index    : 21
Last Oper Chg    : 08/02/2011 01:02:37  Global If Index   : 126
Port Id          : 3/2/6
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 0a:03:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30    Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 27                   Virt. If Index    : 27
Last Oper Chg    : 02/14/2012 00:26:01  Global If Index   : 104
Port Id          : 1/2/6
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 04:03:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30     Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 12                   Virt. If Index    : 12
Last Oper Chg    : 06/06/2011 00:35:49  Global If Index   : 125
Port Id          : 1/2/1
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 04:03:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30    Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 18                   Virt. If Index    : 18
Last Oper Chg    : 06/06/2011 00:35:50  Global If Index   : 124
Port Id          : 2/1/6
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 04:31:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30    Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 26                   Virt. If Index    : 26
Last Oper Chg    : 02/06/2012 23:23:10  Global If Index   : 106
Port Id          : 4/2/1
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 1
Queue-group      : None                 
MAC Address      : 0c:22:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : PIM 
IP Addr/mask     : 14.23.9.278/30     Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 19                   Virt. If Index    : 19
Last Oper Chg    : 08/02/2011 01:02:37  Global If Index   : 123
Port Id          : 3/2/17
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 1
Queue-group      : None                 
MAC Address      : 0a:07:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30     Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 13                   Virt. If Index    : 13
Last Oper Chg    : 06/06/2011 00:35:49  Global If Index   : 122
Port Id          : 1/2/2
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 04:03:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30     Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 15                   Virt. If Index    : 15
Last Oper Chg    : 06/06/2011 00:35:49  Global If Index   : 121
Port Id          : 1/2/3
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 04:03:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30     Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 22                   Virt. If Index    : 22
Last Oper Chg    : 06/06/2011 00:35:49  Global If Index   : 120
Port Id          : 1/2/4
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 04:03:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30     Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 14                   Virt. If Index    : 14
Last Oper Chg    : 09/08/2011 03:37:37  Global If Index   : 119
Port Id          : 1/2/5
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 04:03:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30    Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 25                   Virt. If Index    : 25
Last Oper Chg    : 09/08/2011 03:39:56  Global If Index   : 107
Port Id          : 3/2/14
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 1
Queue-group      : None                 
MAC Address      : 0a:04:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30     Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 16                   Virt. If Index    : 16
Last Oper Chg    : 06/06/2011 00:35:49  Global If Index   : 118
Port Id          : 1/1/6
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 04:4d:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Down/Down
Protocols        : OSPFv2 MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30     Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 3                    Virt. If Index    : 3
Last Oper Chg    : 12/19/2011 10:36:56  Global If Index   : 117
Port Id          : 1/1/5
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 1
Queue-group      : None                 
MAC Address      : 04:4c:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : OSPFv2 MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30      Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 5                    Virt. If Index    : 5
Last Oper Chg    : 09/15/2011 02:36:48  Global If Index   : 116
Port Id          : 1/1/3
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 1
Queue-group      : None                 
MAC Address      : 04:4a:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : OSPFv2 MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30      Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 6                    Virt. If Index    : 6
Last Oper Chg    : 06/06/2011 00:36:39  Global If Index   : 115
Port Id          : 2/1/4
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 1
Queue-group      : None                 
MAC Address      : 04:2f:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Down/Down
Protocols        : OSPFv2 MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30     Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 4                    Virt. If Index    : 4
Last Oper Chg    : 12/19/2011 10:39:41  Global If Index   : 114
Port Id          : 2/1/5
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 1
Queue-group      : None                 
MAC Address      : 04:30:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : OSPFv2 MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30     Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 17                   Virt. If Index    : 17
Last Oper Chg    : 08/04/2011 01:28:32  Global If Index   : 108
Port Id          : 3/1/1
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 1c:11:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : OSPFv2 MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30      Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 8                    Virt. If Index    : 8
Last Oper Chg    : 09/15/2011 02:36:46  Global If Index   : 112
Port Id          : 2/1/3
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 04:2e:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30     Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 7                    Virt. If Index    : 7
Last Oper Chg    : 06/06/2011 00:36:36  Global If Index   : 111
Port Id          : 1/1/1
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 04:09:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP LDP PIM 
IP Addr/mask     : 14.23.9.278/30     Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 23                   Virt. If Index    : 23
Last Oper Chg    : 06/06/2011 00:35:50  Global If Index   : 110
Port Id          : 2/1/1
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 100
Queue-group      : None                 
MAC Address      : 04:2c:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 9198                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Up/Down
Protocols        : ISIS MPLS RSVP PIM 
IP Addr/mask     : 14.23.9.278/32     Address Type      : Primary
IGP Inhibit      : Disabled             Broadcast Address : Host-ones
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 1                    Virt. If Index    : 1
Last Oper Chg    : 06/06/2011 00:35:00  Global If Index   : 256
Port Id          : system
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 1
Queue-group      : None                 
MAC Address      : 04:03:08:03:08:03    Arp Timeout       : 14400
IP Oper MTU      : 1500                 ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
 
-------------------------------------------------------------------------------
Interface
-------------------------------------------------------------------------------
If Name          : Int A
Admin State      : Up                   Oper (v4/v6)      : Down/Down
Protocols        : PIM 
 
IP Addr/mask     : Not Assigned         
-------------------------------------------------------------------------------
Details
-------------------------------------------------------------------------------
Description      : Connect to A
If Index         : 24                   Virt. If Index    : 24
Last Oper Chg    : 06/06/2011 00:34:56  Global If Index   : 109
Port Id          : n/a
TOS Marking      : Trusted              If Type           : Network
Egress Filter    : none                 Ingress Filter    : none
Egr IPv6 Flt     : none                 Ingr IPv6 Flt     : none
SNTP B.Cast      : False                QoS Policy        : 1
Queue-group      : None                 
MAC Address      :                      Arp Timeout       : 14400
IP Oper MTU      : 0                    ICMP Mask Reply   : True
Arp Populate     : Disabled             
Cflowd           : None                 
LdpSyncTimer     : None                 Strip-Label       : Disabled
LSR Load Balance : system               
uRPF Chk         : disabled             
uRPF Fail Bytes  : 0                    uRPF Chk Fail Pkts: 0

Proxy ARP Details
Rem Proxy ARP    : Disabled             Local Proxy ARP   : Disabled
Policies         : none                 

Proxy Neighbor Discovery Details
Local Pxy ND     : Disabled             
Policies         : none                 

ICMP Details
Redirects    : Number - 100                     Time (seconds)   - 10   
Unreachables : Number - 100                     Time (seconds)   - 10   
TTL Expired  : Number - 100                     Time (seconds)   - 10   

IPCP Address Extension Details
Peer IP Addr     : Not configured       
Peer Pri DNS Addr: Not configured       
Peer Sec DNS Addr: Not configured       

Network Domains Associated
default
===============================================================================
*A:AUISJB2879#');
insert into `NE_RUN_DATA`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_TYPE_ID`,`DATA`) values (2,'2014-02-20 15:00:00','14.23.9.278',2,'*A:AUISJB2879# show router arp

===============================================================================
ARP Table (Router: Base)
===============================================================================
IP Address      MAC Address       Expiry    Type   Interface
-------------------------------------------------------------------------------
14.23.9.278   04:03:08:03:08:03 00h00m00s Oth    system
14.17.15.185  01:02:03:8e:2f:11 03h59m44s Dyn[I] To_NE_G5/0/2
14.17.15.186  01:02:03:c0:b3:3c 00h00m00s Oth[I] To_NE_G5/0/2
13.17.15.189  01:02:03:05:79:8f 03h56m05s Dyn[I] To_NE_G6/0/2
-------------------------------------------------------------------------------
No. of ARP Entries: 4
===============================================================================
*A:AUISJB2879#');
insert into `NE_RUN_DATA`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_TYPE_ID`,`DATA`) values (3,'2014-02-20 15:00:00','14.23.9.278',3,'*A:AUISJB2879# show service fdb-mac

===============================================================================
Service Forwarding Database
===============================================================================
ServId    MAC               Source-Identifier        Type   Last Change
                                                     Age
-------------------------------------------------------------------------------
200000316 01:02:03:34:42:9a sdp:11590:200000316      L/75   02/11/2014 12:50:18
200000316 01:02:03:75:f1:d8 sdp:11590:200000316      L/90   12/26/2013 12:28:15
200000316 01:02:03:16:5a:5b sdp:11590:200000316      L/45   02/11/2014 12:51:49
200000316 01:02:03:16:5a:63 sdp:11590:200000316      L/15   02/11/2014 12:52:25
200000316 01:02:03:16:5a:72 sdp:11590:200000316      L/0    02/11/2014 12:51:27
200000003 01:02:03:51:c1:6f sap:1/2/10:275           L/30   02/20/2014 08:36:39
200000003 01:02:03:1d:c7:13 sap:1/2/10:275           L/60   02/20/2014 08:56:31
200000003 01:02:03:bb:b3:8b sap:1/2/10:275           L/255  02/20/2014 08:53:57
200000003 01:02:03:f0:cc:d1 sap:1/2/10:275           L/300  02/20/2014 08:52:52
200006001 01:02:03:17:1c:80 sap:lag-35:2066.0        L/0    02/03/2014 16:42:55
200006001 01:02:03:81:86:65 sap:lag-35:2066.0        L/0    02/12/2014 23:00:26
-------------------------------------------------------------------------------
No. of Entries: 12
-------------------------------------------------------------------------------
Legend: L=Learned; P=MAC is protected
===============================================================================
*A:AUISJB2879#');
insert into `NE_RUN_DATA`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_TYPE_ID`,`DATA`) values (4,'2014-02-20 15:00:00','14.23.9.278',4,'*A:AUISJB2879# show service sdp-using

===============================================================================
SDP Using
===============================================================================
SvcId       SdpId               Type    Far End        Opr S* I.Label  E.Label
-------------------------------------------------------------------------------
200002570   11591:206060001     Spok    14.23.9.171    Up      29554   30689
200000316   11590:720000316     Spok    14.23.9.171    Up      29473   27446
200000318   11591:720000318     Spok    14.23.9.171    Up      29491   27620
200000319   11591:720000319     Spok    14.23.9.172    Up      30408   26753
200001556   11591:720001556     Spok    14.23.9.172    Up      29490   27619
202036160   11590:762036160     Spok    14.23.9.172    Up      30056   26726
200006001   11590:770006001     Spok    14.23.9.173    Down    30433   0
-------------------------------------------------------------------------------
Number of SDPs : 7
-------------------------------------------------------------------------------
===============================================================================
* indicates that the corresponding row element may have been truncated.
*A:AUISJB2879#');
insert into `NE_RUN_DATA`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_TYPE_ID`,`DATA`) values (5,'2014-02-20 15:00:00','14.23.9.278',5,'*A:AUISJB2879# show service sap-using

===============================================================================
Service Access Points
===============================================================================
PortId                          SvcId      Ing.  Ing.    Egr.  Egr.   Adm  Opr
                                           QoS   Fltr    QoS   Fltr
-------------------------------------------------------------------------------
lag-33:3019.0                   200002570  11    none    11    none   Up   Up
lag-31:524.0                    200000316  1     none    1     none   Up   Up
lag-32:524.0                    200000316  1     none    1     none   Up   Up
lag-38:524.0                    200000316  1     none    1     none   Up   Up
1/1/6:555.0                     200000318  999   none    999   none   Up   Up
lag-33:555.0                    200000318  999   none    999   none   Up   Up
lag-35:555.0                    200000318  999   none    999   none   Up   Up
1/1/6:624.0                     200000319  1     none    1     none   Up   Up
1/2/10:556                      200001556  1     none    1     none   Up   Up
lag-35:2000.0                   201122000  204   none    204   none   Up   Up
lag-35:2001.0                   201122001  255   none    255   none   Up   Up
lag-33:2002.0                   201122002  111   none    111   none   Up   Up
-------------------------------------------------------------------------------
Number of SAPs : 12
-------------------------------------------------------------------------------
===============================================================================
*A:AUISJB2879#');
insert into `NE_RUN_DATA`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_TYPE_ID`,`DATA`) values (6,'2014-02-20 15:00:00','14.23.9.278',6,'*A:AUISJB2879# show service service-using

===============================================================================
Services
===============================================================================
ServiceId    Type      Adm  Opr  CustomerId Service Name
-------------------------------------------------------------------------------
200002570    Epipe     Up   Up   3          S11
200000316    VPLS      Up   Up   1          S22
200000318    VPLS      Up   Up   4          S333
200000319    VPLS      Up   Up   4          S444
200001556    VPLS      Up   Up   3          S55555
201122000    Epipe     Up   Up   4          S666666
201122001    Epipe     Up   Up   4          S77777
201122002    Epipe     Up   Up   4          S8888
201122003    Epipe     Up   Up   4          S999999
200004077    Epipe     Up   Up   3          S10000000
202036160    Epipe     Up   Up   2          S1100000000
200006001    VPLS      Up   Up   1          S1200000
2047483648   IES       Up   Down 1          _tmnx_InternalIesService
-------------------------------------------------------------------------------
Matching Services : 13
-------------------------------------------------------------------------------
===============================================================================
*A:AUISJB2879#');
insert into `NE_RUN_DATA`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_TYPE_ID`,`DATA`) values (7,'2014-02-20 15:00:00','14.23.9.278',7,'*A:AUISJB2879# show service customer

===============================================================================
Customers
===============================================================================
Customer-ID        : 1
Contact            : (Not Specified)
Description        : Default customer
Phone              : (Not Specified)

Customer-ID        : 2
Contact            : (Not Specified)
Description        : BHI
Phone              : (Not Specified)

Customer-ID        : 3
Contact            : (Not Specified)
Description        : NMVLL
Phone              : (Not Specified)

Customer-ID        : 4
Contact            : (Not Specified)
Description        : NMVPN
Phone              : (Not Specified)

-------------------------------------------------------------------------------
Total Customers : 4
-------------------------------------------------------------------------------
===============================================================================
*A:AUISJB2879#');
insert into `NE_RUN_DATA`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_TYPE_ID`,`DATA`) values (8,'2014-02-20 15:00:00','14.23.9.278',8,'*A:AUISJB2879# show lag description

===============================================================================
Lag Port States
LACP Status: e - Enabled, d - Disabled
===============================================================================
Lag-id Port-id   Adm   Act/Stdby Opr   Description
-------------------------------------------------------------------------------
31(d)            up              up    "To_SIJ_2A_1_14.10.159.231
                                       "
       1/1/2     up    active    up    "To_SIJ_2A_1_G0/0/21_14.10
                                       .159.231_link1"

       2/1/2     up    active    up    "To_SIJ_2A_1_G0/0/22_14.10
                                       .159.231_link2"


32(d)            up              up    "To_SIJ_2A_2_14.10.159.232
                                       "
       1/2/2     up    active    up    "To_SIJ_2A_2_G0/0/21_14.10
                                       .159.232_link1"

       2/2/2     up    active    up    "To_SIJ_2A_2_G0/0/22_14.10
                                       .159.232_link2"


33(d)            up              up    "To_SIJ_2B_1_14.10.159.233
                                       "
       1/1/3     up    active    up    "To_SIJ_2B_1_G0/0/21_14.10
                                       .159.233_link1"

       2/1/3     up    active    up    "To_SIJ_2B_1_G0/0/22_14.10
                                       .159.233_link2"

									   
35(d)            up              up    "To_SIJ_2C_1_14.10.159.235
                                       "
       1/1/4     up    active    up    "To_SIJ_2C_1_G0/0/21_14.10
                                       .159.235_link1"

       2/1/4     up    active    up    "To_SIJ_2C_1_G0/0/22_14.10
                                       .159.235_link2"


38(d)            up              up    "To_SIJ_3B_2_14.10.159.238
                                       "
       1/2/5     up    active    up    "To_SIJ_3B_2_G0/0/21_14.10
                                       .159.238_link1"

       2/2/5     up    active    up    "To_SIJ_3B_2_G0/0/22_14.10
                                       .159.238_link2"


===============================================================================
*A:AUISJB2879#');
insert into `NE_RUN_DATA`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_TYPE_ID`,`DATA`) values (9,'2014-02-20 15:00:00','14.75.100.1',14,'<SJAHAY02000>display mac-address
MAC Address    VLAN/VSI          Port                      Type       Lsp
----------------------------------------------------------------------------
032a-1205-f7c0 589               GigabitEthernet5/0/2      dynamic    0/0
032a-1205-f7c0 539               GigabitEthernet5/0/2      dynamic    0/0
032a-1205-e740 540               GigabitEthernet6/0/2      dynamic    0/0
032a-12cb-b778 625               GigabitEthernet3/0/1      dynamic    0/0
032a-128d-cfea 2402              GigabitEthernet3/0/1      dynamic    0/0
032a-12cb-b82f 625               GigabitEthernet3/0/2      dynamic    0/0
032a-1269-b7c5 2401              GigabitEthernet3/0/2      dynamic    0/0
032a-1258-239a 2469              GigabitEthernet3/0/3      dynamic    0/0
032a-12a1-2772 625               GigabitEthernet3/0/3      dynamic    0/0
032a-1273-9a47 689               Eth-Trunk1                dynamic    0/0
032a-12f2-c6e2 625               Eth-Trunk1                dynamic    0/0
032a-12f2-c6e2 689               Eth-Trunk1                dynamic    0/0
032a-12a7-10d1 689               Eth-Trunk1                dynamic    0/0
032a-12a5-e76a 689               Eth-Trunk1                dynamic    0/0
032a-12ad-3501 689               Eth-Trunk1                dynamic    0/0

Total matching items displayed = 15

<SJAHAY02000>');
insert into `NE_RUN_DATA`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_TYPE_ID`,`DATA`) values (10,'2014-02-20 15:00:00','14.75.100.1',15,'<SJAHAY02000>display arp
IP ADDRESS      MAC ADDRESS  EXPIRE(M) TYPE INTERFACE      VPN-INSTANCE
                                       VLAN
------------------------------------------------------------------------------
14.75.53.222    032a-12a8-bcce         I -  Vlanif689
14.75.53.91     032a-12a5-36cc  16     D-0  Eth-T1
                                       689
14.75.53.92     032a-12ad-3501  17     D-0  Eth-T1
                                       689
14.75.53.201    032a-12bf-ebc2  19     D-0  Eth-T1
                                       689
14.75.100.1   032a-12a8-bccd         I -  MEth0/0/1
------------------------------------------------------------------------------
Total:5         Dynamic:3       Static:0    Interface:2
<SJAHAY02000>');
insert into `NE_RUN_DATA`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_TYPE_ID`,`DATA`) values (11,'2014-02-20 15:00:00','14.75.100.1',16,'<SJAHAY02000>display interface
Aux0/0/1 current state : UP
Line protocol current state : DOWN
Description : Port description #1
The configured MTU is 1500 bytes, and the active MTU is 1500 bytes
Internet protocol processing : disabled
 Data drive mode: interactive
 loopback not set.
 detect DSR_DTR enabled.
    last 5 minutes input rate 0.0 bytes/sec, 0.0 packets/sec
    last 5 minutes output rate 0.0 bytes/sec, 0.0 packets/sec
    0 packets input,  0 bytes
    0 packets output,  0 bytes
    error: Parity 0, Frame 0, Overrun 0, FIFO 0
 DCD=DOWN  DTR=UP  DSR=DOWN  RTS=UP  CTS=DOWN

Eth-Trunk1 current state : UP
Description : Port description #2
Hash arithmetic : According to SMAC
The Maximum Transmit Unit is 1500 bytes
Internet protocol processing : disabled
IP Sending Frames'' Format is PKTFMT_ETHNT_2, Hardware address is 032a-12a8-bcce

GigabitEthernet2/0/1 current state : DOWN
Description : Port description #3
The Maximum Transmit Unit is 1500 bytes
IP Sending Frames'' Format is PKTFMT_ETHNT_2, Hardware address is 032a-12a8-bcce
AUTO NEGOTIATION, SPEED 1000M, DUPLEX FULL, LOOPBACK NOT SET;
Transmitter''s pause : disable,  Receiver''s pause : disable ;

Last 300 seconds input rate:  0 bits/sec, 0 packets/sec
Last 300 seconds output rate: 0 bits/sec, 0 packets/sec

Input:  0 Packets, 0 Bytes
        0 Broadcasts, 0 Multicasts
        0 Oversizes, 0 Undersizes
        0 FCSs, 0 Pauses

Output: 0 Packets, 0 Bytes
        0 Broadcasts, 0 Multicasts
        0 Oversizes, 0 Defers
        0 FCSs, 0 Pauses
        0 Collisions

GigabitEthernet3/0/1 current state : UP
Description : Port description #4
The Maximum Transmit Unit is 1500 bytes
IP Sending Frames'' Format is PKTFMT_ETHNT_2, Hardware address is 032a-12a8-bcce
NO AUTO NEGOTIATION, SPEED 1000M, DUPLEX FULL, LOOPBACK NOT SET;
Transmitter''s pause : disable,  Receiver''s pause : disable ;
Fiber transceiver information:
  VendorName : HG GENUINE
  Compliance : 1000BASE-LX
  PartNumber : MXPD-243S
  Modes:         Single-Mode
  Wave length: 1310 nm
  Fiber Type Supported and Max Transmission Distance:
  Length for 9um: 10 km
  RxPower: -5.44 dBm(Normal)
  RxPower High Thresholds: -3.00 dBm
  RxPower Low Thresholds: -19.00 dBm
  TxPower: -6.24 dBm(Normal)
  TxPower High Thresholds: -4.26 dBm
  TxPower Low Thresholds: -8.26 dBm
  Bias current: 14854 uA(Normal)
  Bias High Thresholds: 30906 uA
  Bias Low Thresholds: 2472 uA

Last 300 seconds input rate:  39656 bits/sec, 24 packets/sec
Last 300 seconds output rate: 235680 bits/sec, 32 packets/sec

Input:  80532705 Packets, 16496959962 Bytes
        5273 Broadcasts, 2962952 Multicasts
        0 Oversizes, 0 Undersizes
        0 FCSs, 0 Pauses

Output: 114004982 Packets, 100043526849 Bytes
        459265 Broadcasts, 2911777 Multicasts
        0 Oversizes, 0 Defers
        0 FCSs, 0 Pauses
        0 Collisions

MEth0/0/1 current state : DOWN
Line protocol current state : DOWN
Description : Port description #5
The Maximum Transmit Unit is 1500 bytes
Internet Address is 14.75.100.1/24
IP Sending Frames'' Format is PKTFMT_ETHNT_2, Hardware address is 032a-12a8-bccd
 negotiation auto ,     speed 10M ,  duplex half, loopback not set
    5 minutes input rate 0 bytes/sec, 0 packets/sec
    5 minutes output rate 0 bytes/sec, 0 packets/sec
    0 packets input,  0 bytes
    0 input error
    0 input CRC error
    0 input ALIGNMENT error
    0 input RESOURCE error
    0 input OVERRUN error
    0 input COLLISION error
    0 input SHORT FRAME error
    0 packets output,  0 bytes
    0 output error
    0 output MAX COLLISION error
    0 output LATE COLLISION error
    0 output UNDERRUN error
    0 output LOST CRS error
    0 output DEFERRED
    0 output SINGLE COLLISION
    0 output MULTIPLE COLLISION
    0 output TOTAL COLLISION

NULL0 current state : UP
Line protocol current state :UP (spoofing)
Description : Port description #6
The Maximum Transmit Unit is 1500 bytes
Internet protocol processing : disabled

Vlanif689 current state : UP
Line protocol current state : UP
Description : Port description #7
The Maximum Transmit Unit is 1500 bytes
Internet Address is 14.75.53.222/24
IP Sending Frames'' Format is PKTFMT_ETHNT_2, Hardware address is 032a-12a8-bcce

<SJAHAY02000>');
insert into `NE_RUN_DATA`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_TYPE_ID`,`DATA`) values (12,'2014-02-20 15:00:00','14.75.100.1',17,'<SJAHAY02000>display eth-trunk
Eth-Trunk1''s state information is:
Local:
LAG ID: 1                   WorkingMode: STATIC
Preempt Delay: Disabled     Hash arithmetic: According to SMAC
System Priority: 32768      System ID: 032a-12a8-bcce
Least Active-linknumber: 1  Max Bandwidth-affected-linknumber: 8
Operate status: up          Number Of Up Port In Trunk: 1
--------------------------------------------------------------------------------
ActorPortName          Status   PortType PortPri PortNo PortKey PortState Weight
GigabitEthernet5/0/1   Selected 1GE      32768   2561   305     11111100  1

Partner:
--------------------------------------------------------------------------------
ActorPortName          SysPri    SystemID  PortPri PortNo  PortKey   PortState
GigabitEthernet5/0/1   32768  032a-127f-6f65  32768  38027 32784     01111100

Local:
LAG ID: 2                   WorkingMode: STATIC
Preempt Delay: Disabled     Hash arithmetic: According to SMAC
System Priority: 32768      System ID: 032a-12a8-bcce
Least Active-linknumber: 1  Max Bandwidth-affected-linknumber: 8
Operate status: up          Number Of Up Port In Trunk: 1
--------------------------------------------------------------------------------
ActorPortName          Status   PortType PortPri PortNo PortKey PortState Weight
GigabitEthernet5/0/2   Selected 1GE      32768   2561   305     11111100  1

Partner:
--------------------------------------------------------------------------------
ActorPortName          SysPri    SystemID  PortPri PortNo  PortKey   PortState
GigabitEthernet5/0/2   32768  032a-127f-6f66  32768  38027 32784     01111100

<SJAHAY02000>');