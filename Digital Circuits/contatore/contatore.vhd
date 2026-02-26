----------------------------------------------------------------------------------
-- Company: 
-- Engineer: 
-- 
-- Create Date:    14:26:15 12/11/2017 
-- Design Name: 
-- Module Name:    contatore - Behavioral 
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

entity contatore is
    Port ( a : in  STD_LOGIC_VECTOR (3 downto 0);
           y : out  STD_LOGIC_VECTOR (2 downto 0));
end contatore;

architecture Behavioral of contatore is

begin
conta: process (a)
variable cnt: integer;

begin
cnt:=0;
for i in 3 downto 0 loop
    if (a(i)='1') then
    cnt:=cnt+1;
    end if;
end loop;

if cnt=0
then y<="000";
elsif cnt=1
then y<="001";
elsif cnt=2
then y<="010";
elsif cnt=3
then 	y<="011"; 
else y<="100";

end if; 
end process;
end Behavioral;

