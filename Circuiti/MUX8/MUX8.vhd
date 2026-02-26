----------------------------------------------------------------------------------
-- Company: 
-- Engineer: 
-- 
-- Create Date:    12:11:43 12/07/2017 
-- Design Name: 
-- Module Name:    MUX8 - Behavioral 
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

entity MUX8 is
    Port ( I0 : in  STD_LOGIC;
           I1 : in  STD_LOGIC;
           I2 : in  STD_LOGIC;
           I3 : in  STD_LOGIC;
           I4 : in  STD_LOGIC;
           I5 : in  STD_LOGIC;
           I6 : in  STD_LOGIC;
           I7 : in  STD_LOGIC;
           S : in  STD_LOGIC_VECTOR (2 downto 0);
           X : out  STD_LOGIC);
end MUX8;

architecture Behavioral of MUX8 is

begin
process (I0,I1,I2,I3,I4,I5,I6,I7,S;
begin
case S is 
when "000" => x <= I0;
when "001" => x <= I1;
when "010" => x <= I2;
when "011" => x <= I3;
when "100" => x <= I4;
when "101" => x <= I5;
when "110" => x <= I6;
when "111" => x <= I7;
 end case;
 end process;
end Behavioral;




