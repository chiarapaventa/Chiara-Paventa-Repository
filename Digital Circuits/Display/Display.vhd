----------------------------------------------------------------------------------
-- Company: 
-- Engineer: 
-- 
-- Create Date:    11:47:08 12/14/2017 
-- Design Name: 
-- Module Name:    Display - Behavioral 
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


entity Display is
    Port ( bcd : in  STD_LOGIC_VECTOR (4 downto 0);
           y : out  STD_LOGIC_VECTOR (7 downto 0));
end Display;

architecture Behavioral of Display is

begin
case bcd is
when '0000' -> "0000001"; --0
when '0001' -> "0110000"; --1
when '0010' -> "1101101"; --2
when '0011' -> "1111001"; --3
when '0100' -> "0110011"; --4
when '0101' -> "1011011"; --5
when '0111' -> "1011111"; --6
when '1000' -> "1110000"; --7
when '1001' -> "1111111"; --8
when '0000' -> "1111011"; --9
when others -> "0000000"; --0
end case;
end Behavioral;

