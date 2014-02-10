USE nerepdb;

CREATE TABLE `NE_RUN_DATA` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `UPDATE_DATE` datetime NOT NULL,
  `IP_ADDR` varchar(64) NOT NULL,
  `COMMAND` varchar(128) DEFAULT NULL,
  `DATA` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


insert into `NE_RUNING_DATA`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`COMMAND`,`DATA`) values (1,'2013-06-06 01:30:20','14.23.9.278','show router interface detail','*A:AUISJB2879# show router interface detail

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
