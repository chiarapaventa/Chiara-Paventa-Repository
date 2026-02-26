----------------------------------------------------------------------------------
-- Company: 
-- Engineer: 
-- 
-- Create Date:    11:04:05 12/14/2017 
-- Design Name: 
-- Module Name:    HalfAdder - Strutturale 
-- Project Name: 
-- Target Devices: 
-- Tool versions: 
-- Description: 
--
-- Dependencies: 
--
-- Revision: 
-- Revision 0.01 - File Created
-- Additional Comments: 
--
----------------------------------------------------------------------------------
library IEEE;
use IEEE.STD_LOGIC_1164.ALL;

-- Uncomment the following library declaration if using
-- arithmetic functions with Signed or Unsigned values
--use IEEE.NUMERIC_STD.ALL;

-- Uncomment the following library declaration if instantiating
-- any Xilinx primitives in this code.
--library UNISIM;
--use UNISIM.VComponents.all;

entity HalfAdder is
    Port ( I1 : in  STD_LOGIC;
           I0 : in  STD_LOGIC;
           s : out  STD_LOGIC;
           c : out  STD_LOGIC);
end HalfAdder;

architecture Strutturale of HalfAdder is
component AND
port(I0 :in std_logic;
     I1 : in std_logic;
	  O : out std_logic);
end component;

component XOR
port ( I0 :in std_logic;
       I1 : in std_logic;
		 O : out std_logic;
end component;
begin
xx1 : XOR port_map(i1,i0,s);
a1 : AND port map (i1,i0,c);
end Strutturale;

